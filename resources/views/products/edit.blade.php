@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Editar Producto</h1>
    <form action="{{ route('products.update', $product) }}" method="POST" class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="{{ $product->name }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium">Precio</label>
            <input type="number" name="price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ingrese el precio" value="{{ $product->price }}" required step="0.01">
        </div>


        <div class="mb-4">
            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
            <input type="number" name="stock" id="stock" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" value="{{ $product->stock }}" required>
        </div>
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
            <select name="category_id" id="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="suppliers" class="block text-sm font-medium text-gray-700">Proveedores</label>
            <select name="suppliers[]" id="suppliers" multiple class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $product->suppliers->contains($supplier->id) ? 'selected' : '' }}>{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Actualizar</button>
    </form>
@endsection
