@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @php
        function nextDirection($column, $currentSort, $currentDir) {
            return $currentSort === $column && $currentDir === 'asc' ? 'desc' : 'asc';
        }
    @endphp

    @php
        $isIdSort = $sort === 'id';
        $isNombreSort = $sort === 'nombre_apellido';
        $isReclamoSort = $sort === 'tipo_reclamo_queja';
        $isIdFech = $sort === 'fecha_evento';
        $isIdEstado = $sort === 'estado';

        $directionId = $isIdSort ? $direction : 'asc';
        $directionNombre = $isNombreSort ? $direction : 'asc';
        $directionReclamo = $isReclamoSort ? $direction : 'asc';
        $directionFech = $isIdFech ? $direction : 'asc';
        $directionEstado = $isIdEstado ? $direction : 'asc';


        $iconClassId = $directionId === 'asc' ? 'rotate-180' : '';
        $iconClassNombre = $directionNombre === 'asc' ? 'rotate-180' : '';
        $iconClassReclamo = $directionReclamo === 'asc' ? 'rotate-180' : '';
        $iconClassFech = $directionFech ? $direction : 'asc';
        $iconClassEstado = $directionEstado ? $direction : 'asc';

    @endphp

    <!-- Loader global -->
    <div id="loader-wrapper" class="hidden fixed inset-0 z-[9999] bg-white/80 flex flex-col justify-center items-center">
        <img src="/uma/img/logo-uma.png" alt="Cargando UMA" class="w-16 h-16 mb-4 animate-pulse" />
        <div class="loader"></div>
        <p class="text-sm text-gray-700 mt-2">Procesando datos, por favor espera...</p>
    </div>

    <!-- component -->
    <div class="max-w-[100%] mx-auto">
        <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Título -->
                    <div>
                        <h3 class="text-2xl font-semibold text-slate-800">Hojas de Reclamaciones</h3>
                        <p class="text-slate-500">Observa bien las hojas de reclamaciones y deriva según corresponda al área asignada.</p>
                    </div>
                        <!-- Buscador -->
                        <div class="relative w-full max-w-xs mb-4">
                            <input
                                type="text"
                                id="buscador"
                                name="buscador"
                                placeholder=" "
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 text-sm text-blue-gray-700 outline-0 transition-all focus:border-2 focus:border-gray-900 placeholder-shown:border-blue-gray-200"
                                oninput="filtrarTabla()"
                            />
                            <label
                                for="buscador"
                                class="pointer-events-none absolute left-0 -top-1.5 text-[11px] text-gray-500 transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:top-2.5 peer-placeholder-shown:left-3 peer-focus:text-[11px] peer-focus:top-0 peer-focus:left-0 peer-focus:text-gray-900"
                            >
                                Buscar reclamo...
                            </label>
                        </div>
                </div>
            </div>
            <div class="overflow-y-auto max-h-[70vh] mt-4">
                <table class="w-full mt-4 text-left table-auto min-w-max">
                    <thead>
                        <tr>
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                            <a href="?sort=id&direction={{ nextDirection('id', $sort, $direction) }}"
                            class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                            ID
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" aria-hidden="true"
                                class="w-4 h-4 transition-transform {{ $iconClassId}}">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                            </svg>
                            </a>
                        </th>
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                            <a href="?sort=id&direction={{ nextDirection('id', $sort, $direction) }}"
                            class="flex items-center justify-between gap-2 text-sm text-slate-500 font-normal">
                                Nombre Completo
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" aria-hidden="true"
                                    class="w-4 h-4 transition-transform {{ $iconClassNombre}}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </a>
                        </th>
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                            <p
                            class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                            DNI
                            </p>
                        </th>
                        {{-- <th
                            class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                            <p
                            class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                            Tipo Reclamante
                            </p>
                        </th> --}}
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                            <a href="?sort=tipo_reclamo_queja&direction={{ nextDirection('tipo_reclamo_queja', $sort, $direction) }}"
                            class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                            Tipo Reclamo
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" aria-hidden="true"
                                class="w-4 h-4 transition-transform {{ $iconClassReclamo }}">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                            </svg>
                            </a>
                        </th>
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                            <a href="?sort=fecha_evento&direction={{ nextDirection('fecha_evento', $sort, $direction) }}"
                            class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                            Fecha del evento
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" aria-hidden="true"
                                class="w-4 h-4 transition-transform {{ $iconClassFech}}">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                            </svg>
                            </a>
                        </th>
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                            <a href="?sort=estado&direction={{ nextDirection('estado', $sort, $direction) }}"
                            class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                            Estado
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" aria-hidden="true"
                                    class="w-4 h-4 transition-transform {{ $iconClassEstado}}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                                </svg>
                            </a>
                        </th>
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                            <p
                            class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                            Acciones
                            </p>
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reclamos as $reclamo)
                        <tr>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $reclamo->id }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p class="text-sm font-semibold text-slate-700">
                                            {{ Str::title($reclamo->nombre_apellido) }}
                                        </p>
                                        <p class="text-sm text-slate-500">
                                            {{ $reclamo->correo }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200 cursor-pointer"
                                onclick="mostrarInfo('{{ $reclamo->nro_doc }}')">
                                <div class="flex flex-col">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold">
                                        {{ $reclamo->nro_doc }}
                                    </span>
                                </div>
                            </td>
                            {{-- <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ ucfirst($reclamo->estado) }}
                                    </p>
                                </div>
                            </td> --}}
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ ucfirst($reclamo->tipo_reclamo_queja) }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ \Carbon\Carbon::parse($reclamo->fecha_evento)->format('d/m/Y') }}
                                    </p>
                                </div>
                            </td>
                            @php
                                $derivacion = $reclamo->ultimaDerivacion;
                            @endphp
                            <td class="p-4 border-b border-slate-200">
                                @php
                                    $total = $reclamo->derivaciones->count();
                                    $pendientes = $reclamo->derivaciones->where('estado', 0)->count();
                                @endphp

                                @if ($total)
                                    @if ($pendientes > 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-800 text-sm font-semibold">
                                            📤 {{ $pendientes }} pendiente{{ $pendientes > 1 ? 's' : '' }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-semibold">
                                            ✅ Informe completado
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-800 text-sm font-semibold">
                                        🚫 Sin derivación
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                {{-- Botón imprimir --}}
                                <a href="{{ route('libro-reclamaciones.pdf', $reclamo->id) }}"
                                    title="Imprimir"
                                    target="_black"
                                    class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-slate-900 hover:bg-slate-900/10 transition">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                                {{-- Botón ver áreas derivadas --}}
                                <button onclick="toggleAreas({{ $reclamo->id }})"
                                    title="Ver áreas derivadas"
                                    class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-sky-600 hover:bg-sky-100 transition">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                                {{-- Botón derivar --}}
                                <a href="javascript:void(0)" title="Derivar" onclick="abrirModal({{ $reclamo->id }})"
                                    class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-orange-500 hover:bg-slate-900/10 transition">
                                    <i class="fas fa-share"></i>
                                </a>
                                {{-- Botón subir archivo --}}
                                @if (!$reclamo->informe_responsable)
                                    {{-- Ícono para subir archivo --}}
                                    <form action="{{ route('libroreclamaciones.subirInforme', $reclamo->id) }}"
                                        method="POST" enctype="multipart/form-data" id="form-informe-{{ $reclamo->id }}" class="inline">
                                        @csrf
                                        <input type="file" name="informe_responsable" accept=".pdf,.doc,.docx"
                                            onchange="document.getElementById('form-informe-{{ $reclamo->id }}').submit()" hidden id="archivo-{{ $reclamo->id }}">

                                        <button type="button" title="Subir informe"
                                            class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-blue-600 hover:bg-blue-100 transition"
                                            onclick="document.getElementById('archivo-{{ $reclamo->id }}').click()">
                                            <i class="fa-solid fa-upload"></i>
                                        </button>
                                    </form>
                                @else
                                    {{-- Ícono para ver archivo --}}
                                    <a href="{{ asset('storage/informes_responsables/' . $reclamo->informe_responsable) }}"
                                        target="_blank"
                                        title="Ver informe subido"
                                        class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-green-600 hover:bg-green-100 transition">
                                        <i class="fa-solid fa-file-lines"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <!-- Fila desplegable de detalles -->
                        <tr id="detalle-{{ $reclamo->id }}" class="bg-gray-50 text-sm text-slate-700 hidden">
                            <td colspan="7" class="p-4 border-b border-slate-200">
                                <div class="flex flex-col gap-2">
                                    @foreach ($reclamo->derivaciones as $d)
                                        <div class="bg-white p-3 rounded border border-slate-200 shadow-sm flex justify-between items-start flex-wrap gap-2">
                                            <div class="flex-1">
                                                <p class="font-semibold">📤 Área derivada: {{ $d->area->nombre }}</p>
                                                <p><strong>Estado:</strong> 
                                                    <span class="text-{{ $d->estado == 2 ? 'green' : ($d->estado == 1 ? 'yellow' : 'gray') }}-700 font-semibold">
                                                        {{ ['Pendiente', 'En proceso', 'Completado'][$d->estado] }}
                                                    </span>
                                                </p>
                                                <p><strong>Comentario:</strong> {{ $d->comentario ?? 'Sin comentario' }}</p>
                                                <p>
                                                    <strong>Archivo:</strong>
                                                    @if ($d->archivo)
                                                        <a href="{{ asset('storage/' . $d->archivo) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:underline">
                                                            Ver archivo
                                                        </a>
                                                    @else
                                                        No se adjuntó archivo
                                                    @endif
                                                </p>
                                            </div>
                                            @if ($d->estado == 2 && $d->informe)
                                                <a href="{{ route('derivacion.informe_pdf', $d->id) }}"
                                                    title="Descargar Informe"
                                                    target="_blank"
                                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-red-600 hover:bg-red-100 transition text-sm font-medium">
                                                    <i class="fa-solid fa-file-pdf"></i> Descargar Informe
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-between p-3">
                <p class="block text-sm text-slate-500">
                    Página {{ $reclamos->currentPage() }} de {{ $reclamos->lastPage() }}
                </p>
                <div class="flex gap-1">
                    {{-- Botón Anterior --}}
                    <a href="{{ $reclamos->previousPageUrl() }}" 
                    class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600 transition-all hover:opacity-75 {{ $reclamos->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
                        Anterior
                    </a>

                    {{-- Botón Siguiente --}}
                    <a href="{{ $reclamos->nextPageUrl() }}" 
                    class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600 transition-all hover:opacity-75 {{ !$reclamos->hasMorePages() ? 'opacity-50 pointer-events-none' : '' }}">
                        Siguiente
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Derivar -->
    <div id="modal-derivar" class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
            <button onclick="cerrarModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold text-[#880E4F] mb-4">Derivar Hoja de Reclamación</h2>

            <form id="form-derivar" method="POST" action="{{ route('derivar.reclamo') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="reclamo_id" id="reclamo_id_modal">

                <div class="mb-4">
                    <label for="area_id" class="block font-semibold mb-1">Área destino:</label>
                    <select name="area_id" id="area_id" required class="w-full border border-gray-300 rounded px-3 py-2">
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="observaciones" class="block font-semibold mb-1">Observaciones:</label>
                    <textarea name="observaciones" id="observaciones" rows="4" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Motivo o comentario adicional..."></textarea>
                </div>

                <div class="mb-4">
                    <label for="archivo" class="block font-semibold mb-1">Adjuntar archivo:</label>
                    <input type="file" name="archivo" id="archivo" class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-[#880E4F] text-white px-4 py-2 rounded hover:bg-[#6a0c3d]">Derivar</button>
                </div>
            </form>
        </div>
    </div>


<!-- Modal -->
<div id="modalAlumno" class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg animate-fadeIn">
        
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-slate-800">📋 Información del Alumno</h2>
        <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        </div>

        <!-- Body -->
        <div class="px-6 py-5">
        <dl class="divide-y divide-gray-200">
            <div class="py-2 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-600">Código</dt>
            <dd class="col-span-2 text-sm text-gray-900" id="codigo"></dd>
            </div>
            <div class="py-2 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-600">Apellido Paterno</dt>
            <dd class="col-span-2 text-sm text-gray-900" id="paterno"></dd>
            </div>
            <div class="py-2 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-600">Apellido Materno</dt>
            <dd class="col-span-2 text-sm text-gray-900" id="materno"></dd>
            </div>
            <div class="py-2 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-600">Nombres</dt>
            <dd class="col-span-2 text-sm text-gray-900" id="nombres"></dd>
            </div>
            <div class="py-2 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-600">Especialidad</dt>
            <dd class="col-span-2 text-sm text-gray-900" id="nomesp"></dd>
            </div>
            <div class="py-2 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-600">DNI</dt>
            <dd class="col-span-2 text-sm text-gray-900" id="c_dni"></dd>
            </div>
            <div class="py-2 grid grid-cols-3 gap-4">
            <dt class="text-sm font-medium text-gray-600">Email Institucional</dt>
            <dd class="col-span-2 text-sm text-gray-900 break-all" id="c_email_institucional"></dd>
            </div>
        </dl>
        </div>

        <!-- Footer -->
        <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
        <button onclick="cerrarModal()" 
                class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
            Cerrar
        </button>
        </div>
    </div>
</div>

<style>
/* animación suave */
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95);}
    to { opacity: 1; transform: scale(1);}
}
.animate-fadeIn { animation: fadeIn 0.2s ease-out; }
</style>


    <script>
        function abrirModal(reclamoId) {
            document.getElementById('reclamo_id_modal').value = reclamoId;
            document.getElementById('modal-derivar').classList.remove('hidden');
        }

        function cerrarModal() {
            document.getElementById('modal-derivar').classList.add('hidden');
        }
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Derivación exitosa!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#880E4F'
            });
        </script>
    @endif

    @if(session('successdrift'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Envio exitoso!',
                text: '{{ session('successdrift') }}',
                confirmButtonColor: '#880E4F'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            let errores = @json($errors->all());
            Swal.fire({
                icon: 'error',
                title: 'Error al derivar',
                html: '<ul style="text-align:left;">' + errores.map(e => `<li>• ${e}</li>`).join('') + '</ul>',
                confirmButtonColor: '#880E4F'
            });
        </script>
    @endif

    <script>
        const derivacionesExistentes = @json(
            $reclamos->pluck('derivaciones')->flatten()->groupBy('libro_reclamacion_id')
        );

        document.getElementById('form-derivar').addEventListener('submit', function (e) {
            e.preventDefault(); // Evita envío inmediato
            const reclamoId = document.getElementById('reclamo_id_modal').value;
            const areaIdSeleccionada = document.getElementById('area_id').value;

            const derivaciones = derivacionesExistentes[reclamoId] || [];
            const yaDerivado = derivaciones.some(d => d.area_id == areaIdSeleccionada);

            if (yaDerivado) {
                Swal.fire({
                    title: '¿Deseas continuar?',
                    text: '⚠️ Ya se ha derivado este reclamo a esta área anteriormente.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, derivar otra vez',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('loader-wrapper').classList.remove('hidden');
                        e.target.submit(); // Envía el form
                    }
                });
            } else {
                document.getElementById('loader-wrapper').classList.remove('hidden');
                e.target.submit();
            }
        });
    </script>

    <script>
        function toggleAreas(id) {
            const fila = document.getElementById('detalle-' + id);
            fila.classList.toggle('hidden');
        }
    </script>

    <script>
        function  filtrarTabla() {
            const filtro = document.getElementById("buscador").value.toLowerCase();
            const filas = document.querySelectorAll("tbody tr");

            filas.forEach(fila => {
                const textoFila = fila.textContent.toLowerCase();
                fila.style.display = textoFila.includes(filtro) ? "" : "none";
            });
        }
    </script>

    <script>
        function mostrarInfo(dni) {
            fetch(`/alumno/${dni}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('codigo').innerText = data.codigo ?? '';
                        document.getElementById('paterno').innerText = data.paterno ?? '';
                        document.getElementById('materno').innerText = data.materno ?? '';
                        document.getElementById('nombres').innerText = data.nombres ?? '';
                        document.getElementById('nomesp').innerText = data.nomesp ?? '';
                        document.getElementById('c_dni').innerText = data.c_dni ?? '';
                        document.getElementById('c_email_institucional').innerText = data.c_email_institucional ?? '';

                        document.getElementById('modalAlumno').classList.remove('hidden');
                    }
                });
        }

        function cerrarModal() {
            document.getElementById('modalAlumno').classList.add('hidden');
        }
    </script>

@endsection