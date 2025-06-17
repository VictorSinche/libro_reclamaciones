<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold mb-6">📊 Dashboard de Reclamos</h1>

    <!-- Tarjetas resumen -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Reclamos -->
        <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4 hover:shadow-2xl transition duration-300">
            <div class="bg-indigo-100 text-indigo-600 p-4 rounded-full shadow-md">
                <!-- Heroicon: Clipboard List -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h2l1-1h4l1 1h2a2 2 0 012 2v11a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-gray-500 text-sm uppercase">Total de Reclamos</h2>
                <p class="text-3xl font-bold text-indigo-700">{{ $totalReclamos }}</p>
            </div>
        </div>

        <!-- Derivados -->
        <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4 hover:shadow-2xl transition duration-300">
            <div class="bg-blue-100 text-blue-600 p-4 rounded-full shadow-md">
                <!-- Heroicon: Paper Airplane -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </div>
            <div>
                <h2 class="text-gray-500 text-sm uppercase">Derivados</h2>
                <p class="text-3xl font-bold text-blue-700">{{ $derivados }}</p>
            </div>
        </div>

        <!-- Atendidos -->
        <div class="bg-white shadow-lg rounded-xl p-6 flex items-center space-x-4 hover:shadow-2xl transition duration-300">
            <div class="bg-green-100 text-green-600 p-4 rounded-full shadow-md">
                <!-- Heroicon: Check Circle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4-4m5 2a9 9 0 11-18 0a9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-gray-500 text-sm uppercase">Atendidos</h2>
                <p class="text-3xl font-bold text-green-700">{{ $atendidos }}</p>
            </div>
        </div>
    </div>

  <!-- Gráficos estadísticos -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">

      <!-- Tipo de Reclamo -->
      <div class="bg-white shadow-md rounded-lg p-6">
          <h2 class="text-lg font-semibold mb-4 text-blue-600">🧾 Tipos de Reclamo</h2>
          <div id="chartTipo"></div>
      </div>
    
    {{-- Cumplimiento de Informe Responsable --}}
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-yellow-600">📄 Informe Responsable</h2>
        <div id="chartInforme"></div>
    </div>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-green-600">📈 Evolución Mensual</h2>
        <div id="chartMeses" class="w-full"></div>
    </div>

    <!-- Reclamos por Estado -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-purple-600">🏢 Reclamos por Área</h2>
        <div id="chartArea"></div>
    </div>
  </div>

</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 🧾 Tipos de Reclamo
        const chartTipo = new ApexCharts(document.querySelector("#chartTipo"), {
            chart: { type: 'donut', height: 250 },
            series: [{{ $totalReclamosQueja }}, {{ $totalReclamosReclamo }}],
            labels: ['Queja', 'Reclamo'],
            colors: ['#6366f1', '#f59e0b']
        });
        chartTipo.render();

        // 📈 Reclamos por Mes
        const chartMeses = new ApexCharts(document.querySelector("#chartMeses"), {
            chart: { type: 'line', height: 300 },
            series: [{
                name: 'Reclamos',
                data: {!! json_encode($reclamosPorMesValores) !!}
            }],
            xaxis: {
                categories: {!! json_encode($reclamosPorMesMeses) !!},
                labels: { rotate: -45 }
            },
            stroke: { curve: 'smooth' },
            colors: ['#0ea5e9']
        });
        chartMeses.render();

        const chartInforme = new ApexCharts(document.querySelector("#chartInforme"), {
            chart: { type: 'donut', height: 250 },
            series: [{{ $conInforme }}, {{ $sinInforme }}],
            labels: ['Con Informe', 'Sin Informe'],
            colors: ['#22c55e', '#ef4444'], // verde y rojo
            tooltip: {
                y: {
                    formatter: val => `${val} reclamos`
                }
            }
        });
        chartInforme.render();

    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // 🏢 Reclamos por Área (colores distintos por barra)
    const chartArea = new ApexCharts(document.querySelector("#chartArea"), {
        chart: { type: 'bar', height: 250 },
        series: [{
            name: 'Reclamos',
            data: {!! json_encode($areasValores) !!}
        }],
        xaxis: {
            categories: {!! json_encode($areasLabels) !!},
            labels: { style: { fontSize: '13px' } }
        },
        plotOptions: {
            bar: {
                distributed: true     // ← ¡clave para colores por barra!
            }
        },
        colors: {!! json_encode($colores->values()) !!} // garantiza array plano
    });

    chartArea.render();

    /* …resto de tus gráficos (chartTipo, chartMeses)… */
});
</script>

