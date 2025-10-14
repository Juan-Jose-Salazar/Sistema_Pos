@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-md rounded-xl p-8 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Editar Rol</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-4 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('rols.update', $rol->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="rol_name" class="block text-sm font-semibold text-gray-700 mb-2">
                Nombre del Rol
            </label>
            <input type="text" id="rol_name" name="rol_name" value="{{ old('rol_name', $rol->rol_name) }}"
                   class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-lg p-2.5 outline-none" 
                   placeholder="Ej: Administrador, Cajero, Vendedor...">
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('rols.index') }}"
               class="text-gray-600 hover:text-gray-900 text-sm underline">
               ← Volver a la lista
            </a>
           <button type="submit" class="btn-primary">Actualizar Rol</button>
            </button>
        </div>
    </form>
</div>
@endsection
