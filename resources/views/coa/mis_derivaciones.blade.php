@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="max-w-[100%] mx-auto">
    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Título -->
            <div>
                <h3 class="text-2xl font-semibold text-slate-800">Derivaciones recibidas</h3>
                <p class="text-slate-500"></p>
            </div>
            <!-- Contenedor derecho: buscador + formulario -->
            <div class="flex flex-col sm:flex-row items-center gap-3">
                <!-- Buscador -->
                <div class="w-full md:w-72">
                    <div class="relative h-10 w-full min-w-[200px]">
                        <div class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                            </svg>
                        </div>
                        <input
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900">
                            Buscar
                        </label>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="p-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        ID
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        Reclamante
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        DNI
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Motivo
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Fecha del evento
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Estado
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
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
                    @foreach ($derivaciones as $item)
                    <tr>
                        <!-- Datos principales -->
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">{{ $item->id }}</p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex items-center gap-3">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">{{ Str::title($item->libroReclamacion->nombre_apellido) }}</p>
                                    <p class="text-sm text-slate-500">{{ $item->libroReclamacion->correo }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <p class="text-sm font-semibold text-slate-700">{{ $item->libroReclamacion->nro_doc }}</p>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <p class="text-sm font-semibold text-slate-700">{{ ucfirst($item->libroReclamacion->motivo_reclamo) }}</p>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <p class="text-sm font-semibold text-slate-700">{{ \Carbon\Carbon::parse($item->fecha_derivacion)->format('d/m/Y') }}</p>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            @php
                                $estados = [
                                    '0' => ['label' => 'Pendiente', 'color' => 'bg-gray-200 text-gray-800'],
                                    '1' => ['label' => 'En proceso', 'color' => 'bg-yellow-200 text-yellow-800'],
                                    '2' => ['label' => 'Atendido', 'color' => 'bg-green-200 text-green-800'],
                                ];
                            @endphp

                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $estados[$item->estado]['color'] }}">
                                {{ $estados[$item->estado]['label'] }}
                            </span>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <!-- Botón imprimir -->
                            <a href="{{ route('libro-reclamaciones.pdf', ['id' => $item->libro_reclamacion_id]) }}" target="_blank"
                                title="Imprimir"
                                class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-slate-900 hover:bg-slate-900/10 transition">
                                <i class="fa-solid fa-print"></i>
                            </a>
                            <!-- Botón para mostrar detalles -->
                            <a href="javascript:void(0)" title="Información"
                                onclick="toggleDetalle({{ $item->id }})"
                                class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-blue-600 hover:bg-slate-900/10 transition">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                            <!-- Botón de completar derivación -->
                            @if ($item->estado == 1)
                                <form id="form-marcar-{{ $item->id }}" method="POST" action="{{ route('derivacion.completar', $item->id) }}" class="inline">
                                    @csrf
                                    <button type="button" title="Marcar como atendido"
                                        onclick="confirmarAtencion({{ $item->id }})"
                                        class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-green-700 hover:bg-green-100 transition">
                                        <i class="fa-solid fa-check-circle"></i>
                                    </button>
                                </form>
                            @endif

                            <!-- Botón para abrir modal de informe -->
                            @if ($item->estado != 2) {{-- solo si aún no está atendido --}}
                            <button 
                                data-id="{{ $item->id }}" 
                                data-informe="{{ $item->informe }}" 
                                onclick="abrirModalInforme(this)"
                                class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-indigo-700 hover:bg-indigo-100 transition" 
                                title="Redactar informe">
                                <i class="fa-solid fa-file-pen"></i>
                            </button>
                            @endif
                            @if ($item->informe)
                                <a href="{{ route('derivacion.informe_pdf', $item->id) }}" target="_blank"
                                    class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-red-700 hover:bg-red-100 transition"
                                    title="Descargar informe PDF">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                            @endif
                        </td>
                    </tr>

                    <!-- Fila de detalles ocultable -->
                    <tr id="detalle-{{ $item->id }}" class="bg-gray-50 text-sm text-slate-700 hidden">
                        <td colspan="7" class="p-4 border-b border-slate-200">
                            <strong>Comentario:</strong> {{ $item->comentario ?? 'Sin comentario' }}<br>
                            <strong>Archivo:</strong>
                            @if ($item->archivo)
                                <a href="{{ asset('storage/derivaciones/' . $item->archivo) }}"
                                target="_blank"
                                class="text-blue-600 hover:underline">
                                Ver archivo
                                </a>
                            @else
                                No se adjuntó archivo
                            @endif
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

@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    });
</script>
@endif

@endsection

<script>
    function toggleDetalle(id) {
        const fila = document.getElementById(`detalle-${id}`);
        fila.classList.toggle('hidden');
    }
</script>

<!-- Modal de informe avanzado -->
<div id="modalInforme" class="fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white w-full max-w-5xl max-h-[90vh] overflow-auto p-6 rounded-lg shadow-xl relative animate__animated animate__fadeIn">
        <h2 class="text-2xl font-bold mb-4 text-indigo-700 flex justify-between items-center">
            Redactar Informe del Área
            <button onclick="cerrarModalInforme()" class="text-red-500 hover:text-red-700 text-xl">&times;</button>
        </h2>
        <form method="POST" action="{{ route('derivacion.guardar_informe') }}">
            @csrf
            <input type="hidden" name="id" id="derivacionId">

            <textarea name="informe" id="editor" class="w-full h-[500px] border border-gray-300"></textarea>

            <div class="flex justify-end mt-6 gap-2">
                <button type="button" onclick="cerrarModalInforme()" class="px-5 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                    Cancelar
                </button>
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Guardar informe
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CKEditor desde CDN -->
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic@36.0.1/build/ckeditor.js"></script>

<script>
    let editorInstance;

    // Adaptador personalizado para subir imágenes
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file.then(file => new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('upload', file);

                fetch('/ckeditor/upload', {
                    method: 'POST',
                    body: data,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    resolve({ default: data.url });
                })
                .catch(error => {
                    reject(error);
                });
            }));
        }

        abort() {}
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    // Abrir el modal e inicializar CKEditor
    function abrirModalInforme(btn) {
        const id = btn.getAttribute('data-id');
        const contenido = btn.getAttribute('data-informe') || '';

        document.getElementById('derivacionId').value = id;
        document.getElementById('modalInforme').classList.remove('hidden');

        // Si ya existe una instancia, destruirla
        if (editorInstance) {
            editorInstance.destroy().then(() => initEditor(contenido));
        } else {
            initEditor(contenido);
        }
    }

    // Crear CKEditor
    function initEditor(contenido) {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [ MyCustomUploadAdapterPlugin ],
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'alignment', '|',
                    'bulletedList', 'numberedList', '|',
                    'imageUpload', '|',
                    'insertTable', '|',
                    'undo', 'redo'
                ],
                image: {
                    resizeUnit: '%',
                    resizeOptions: [
                        {
                            name: 'resizeImage:original',
                            label: 'Original',
                            value: null
                        },
                        {
                            name: 'resizeImage:50',
                            label: '50%',
                            value: '50'
                        },
                        {
                            name: 'resizeImage:75',
                            label: '75%',
                            value: '75'
                        }
                    ],
                    toolbar: [
                        'imageStyle:alignLeft',
                        'imageStyle:alignCenter',
                        'imageStyle:alignRight',
                        '|',
                        'resizeImage'
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                }
            })
            .then(editor => {
                editor.setData(contenido);
                editorInstance = editor;
            })
            .catch(error => {
                console.error('Error al cargar CKEditor:', error);
            });
    }
    // Cerrar el modal
    function cerrarModalInforme() {
        if (editorInstance) {
            editorInstance.destroy().then(() => {
                editorInstance = null;
            });
        }
        document.getElementById('modalInforme').classList.add('hidden');
    }
</script>

<script>
    function confirmarAtencion(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Una vez marcado como atendido, ya no podrás editar el informe.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-marcar-' + id).submit();
            }
        });
    }
</script>