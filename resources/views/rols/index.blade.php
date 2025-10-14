@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col items-center py-10">
    <div class="bg-white shadow-lg rounded-2xl w-full max-w-4xl p-8 border border-gray-200">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Lista de Roles</h1>
       <a href="{{ route('rols.create') }}" class="btn-primary">+ Nuevo Rol</a> 
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 rounded-lg px-4 py-2 mb-5">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full border-collapse rounded-lg overflow-hidden">
        <thead class="bg-blue-50 border-b border-gray-300">
            <tr>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 uppercase">ID</th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 uppercase">Nombre</th>
                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rols as $rol)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-4 border-b border-gray-200">{{ $rol->id }}</td>
                    <td class="py-3 px-4 border-b border-gray-200">{{ $rol->rol_name }}</td>
                    <td class="py-3 px-4 border-b border-gray-200 flex gap-3">
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

@endsection
