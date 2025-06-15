@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-5 px-2">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Asignar Áreas a Usuarios</h2>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    <div class="overflow-x-auto rounded shadow-sm">
        <table class="min-w-full bg-white border border-gray-200 text-sm text-gray-700">
            <thead class="bg-gray-100 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
                <tr>
                    <th class="px-4 py-3 border-b border-gray-200">Usuario</th>
                    <th class="px-4 py-3 border-b border-gray-200">Área</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($usuarios as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-2 whitespace-nowrap">{{ $user->nombre }} {{ $user->apellidos }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('user.asignarArea') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <select name="area_id" onchange="this.form.submit()" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Selecciona área --</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}" {{ $user->area_id == $area->id ? 'selected' : '' }}>
                                            {{ $area->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
