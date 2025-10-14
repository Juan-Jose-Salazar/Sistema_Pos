@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col items-center py-10">
    <div class="bg-white shadow-md rounded-lg w-full max-w-3xl p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Lista de Roles</h1>

        @if(session('success'))
            <div class="text-green-600 font-semibold mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('rols.create') }}" 
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition mb-4">
           Crear nuevo rol
        </a>

        <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Nombre</th>
                    <th class="py-2 px-4 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rols as $rol)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $rol->id }}</td>
                    <td class="py-2 px-4">{{ $rol->rol_name }}</td>
                    <td class="py-2 px-4 flex gap-3">
                        <a href="{{ route('rols.edit', $rol->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>

                        <form action="{{ route('rols.destroy', $rol->id) }}" method="POST" 
                              onsubmit="return confirm('¿Seguro que quieres eliminar este rol?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 font-medium">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
