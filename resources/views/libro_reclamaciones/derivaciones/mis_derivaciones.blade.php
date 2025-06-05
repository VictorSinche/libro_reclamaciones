@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-bold mb-4">Derivaciones recibidas</h2>

    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">Reclamante</th>
                <th class="p-2">Motivo</th>
                <th class="p-2">Fecha</th>
                <th class="p-2">Estado</th>
                <th class="p-2">Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($derivaciones as $item)
                <tr class="border-t">
                    <td class="p-2">{{ $item->libroReclamacion->nombre_apellido }}</td>
                    <td class="p-2">{{ Str::limit($item->libroReclamacion->motivo_reclamo, 30) }}</td>
                    <td class="p-2">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="p-2 capitalize">{{ $item->estado }}</td>
                    <td class="p-2">
                        <a href="{{ route('libro-reclamaciones.pdf', ['id' => $item->libro_reclamacion_id]) }}" 
                            class="text-blue-600 hover:underline"
                            target="_black"
                            >
                            Ver hoja
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">No hay derivaciones asignadas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
