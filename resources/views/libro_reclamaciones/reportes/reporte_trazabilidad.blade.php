@extends('layouts.app')

@section('title', 'Reportes de Reclamos')

@section('content')
    <main class="max-w mx-auto p-5">
    <header class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Descarga de reportes – Libro de Reclamaciones</h1>
        <p class="text-sm text-gray-500">Reportes institucionales listos para auditoría y control interno.</p>
    </header>

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- General -->
        <article class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition">
        <div class="p-5">
            <div class="flex items-center gap-3 mb-3">
            <span class="p-2 rounded-xl bg-indigo-50 text-indigo-600">
                <i class="fa-solid fa-file-arrow-down text-lg" aria-hidden="true"></i>
            </span>
            <h2 class="font-medium text-gray-900">Reporte Consolidado General</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4"></p>
            <a href="{{ route('reclamos.export.general') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
            aria-label="Descargar reporte General"
            target="_blank"
            >
            <i class="fa-solid fa-download text-sm" aria-hidden="true"></i>
            <span>Descargar</span>
            </a>
        </div>
        </article>

        <!-- Derivados (Pendiente de Informe) -->
        <article class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition">
        <div class="p-5">
            <div class="flex items-center gap-3 mb-3">
            <span class="p-2 rounded-xl bg-amber-50 text-amber-600">
                <i class="fa-solid fa-clock text-lg" aria-hidden="true"></i>
            </span>
            <h2 class="font-medium text-gray-900">REGISTRO -> DERIVACIÓN</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4"></p>
            <a href="{{ route('reclamos.export.derivados_pend_inf') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-600 text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:ring-offset-2"
            aria-label="Descargar reporte Derivados pendiente de informe"
            target="_blank">
            <i class="fa-solid fa-download text-sm" aria-hidden="true"></i>
            <span>Descargar</span>
            </a>
        </div>
        </article>

        <!-- Informes completados (Pendiente de Envío) -->
        <article class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition">
        <div class="p-5">
            <div class="flex items-center gap-3 mb-3">
            <span class="p-2 rounded-xl bg-sky-50 text-sky-600">
                <i class="fa-solid fa-circle-check text-lg" aria-hidden="true"></i>
            </span>
            <h2 class="font-medium text-gray-900">DERIVACIÓN -> INFORME COMPLETADO</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4"></p>
            <a href="{{ route('reclamos.export.inf_completado_pend_envio') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-sky-600 text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-600 focus:ring-offset-2"
            aria-label="Descargar reporte Informes completados pendiente de envío"
            target="_blank">
            <i class="fa-solid fa-download text-sm" aria-hidden="true"></i>
            <span>Descargar</span>
            </a>
        </div>
        </article>

        <!-- Enviados -->
        <article class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition">
        <div class="p-5">
            <div class="flex items-center gap-3 mb-3">
            <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                <i class="fa-solid fa-paper-plane text-lg" aria-hidden="true"></i>
            </span>
            <h2 class="font-medium text-gray-900">INFORME COMPLETADO -> ENVÍO AL ESTUDIANTE</h2>
            </div>
            <p class="text-sm text-gray-600 mb-4"></p>
            <a href="{{ route('reclamos.export.enviados') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2"
            aria-label="Descargar reporte Enviados"
            target="_blank">
            <i class="fa-solid fa-download text-sm" aria-hidden="true"></i>
            <span>Descargar</span>
            </a>
        </div>
        </article>
    </section>
    </main>
@endsection
