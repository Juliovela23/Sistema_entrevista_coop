@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Editar Categoría</h1>

    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nombre de la categoría" required>
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Descripción</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Descripción de la categoría" rows="4">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md">Actualizar Categoría</button>
            </div>
        </form>
    </div>
@endsection
