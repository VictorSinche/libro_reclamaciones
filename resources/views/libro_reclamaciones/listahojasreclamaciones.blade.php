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

                    <!-- Contenedor derecho: buscador + formulario -->
                    <div class="flex flex-col sm:flex-row items-center gap-3">
                        <!-- Buscador -->
                        <div class="w-full md:w-72">
                            <form method="GET" action="{{ route('admision.libroRe') }}" class="w-full md:w-72">
                                <div class="relative h-10 w-full min-w-[200px]">
                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline-0"
                                        placeholder="Buscar por nombre, DNI o correo" />

                                    <button type="submit" class="absolute top-1/2 right-3 -translate-y-1/2 text-blue-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
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
                        <th
                            class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                            <p
                            class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                            Tipo Reclamante
                            </p>
                        </th>
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
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $reclamo->nro_doc }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ ucfirst($reclamo->tipo_reclamante) }}
                                    </p>
                                </div>
                            </td>
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
                                $estados = [
                                    0 => ['label' => 'Pendiente de derivación', 'color' => 'bg-yellow-100 text-yellow-800', 'icon' => '⏳'],
                                    1 => ['label' => 'Derivado al área', 'color' => 'bg-blue-100 text-blue-800', 'icon' => '📤'],
                                    2 => ['label' => 'Reclamo resuelto', 'color' => 'bg-green-100 text-green-800', 'icon' => '✅'],
                                ];
                                $estado = $estados[$reclamo->estado];
                            @endphp

                            <td class="p-4 border-b border-slate-200">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $estado['color'] }}">
                                    {{ $estado['icon'] }} {{ $estado['label'] }}
                                    @if($reclamo->estado == 1 && $reclamo->ultimaDerivacion && $reclamo->ultimaDerivacion->area)
                                        de {{ $reclamo->ultimaDerivacion->area->nombre }}
                                    @endif
                                </span>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                {{-- Botón imprimir --}}
                                <a href="{{ route('libro-reclamaciones.pdf', $reclamo->id) }}"
                                    title="Imprimir"
                                    target="_black"
                                    class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-slate-900 hover:bg-slate-900/10 transition">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                                {{-- Botón derivar --}}
                                <a href="javascript:void(0)" title="Derivar" onclick="abrirModal({{ $reclamo->id }})"
                                    class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-slate-900 hover:bg-slate-900/10 transition">
                                    <i class="fas fa-share"></i>
                                </a>
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
    <div id="modal-derivar" class="fixed inset-0 bg-black/10 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
            <button onclick="cerrarModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
            <h2 class="text-xl font-bold text-[#880E4F] mb-4">Derivar Hoja de Reclamación</h2>

            <form id="form-derivar" method="POST" action="{{ route('derivar.reclamo') }}">
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

                <div class="text-right">
                    <button type="submit" class="bg-[#880E4F] text-white px-4 py-2 rounded hover:bg-[#6a0c3d]">Derivar</button>
                </div>
            </form>
        </div>
    </div>

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

@endsection