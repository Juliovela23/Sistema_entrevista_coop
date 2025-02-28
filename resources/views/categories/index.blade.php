@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">Administrar Categorías</h1>

    <div class="flex justify-end mb-4">
        <a href="{{ route('categories.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">Crear Categoría</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $category->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                        <a href="{{ route('categories.edit', $category) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg">Editar</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
