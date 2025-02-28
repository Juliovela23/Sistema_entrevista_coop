@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Crear Producto</h2>
            <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-medium">Nombre</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ingrese el nombre del producto" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Precio</label>
                    <input type="number" name="price" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ingrese el precio" required step="0.01">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Stock</label>
                    <input type="number" name="stock" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ingrese la cantidad en stock" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Categoría</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="" disabled selected>Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Proveedores</label>
                    <select name="suppliers[]" multiple class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-sm text-gray-500 mt-1">Mantenga presionada la tecla CTRL (CMD en Mac) para seleccionar múltiples proveedores.</p>
                </div>
                <div class="flex justify-center space-x-4">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Guardar</button>
                    <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
