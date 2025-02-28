@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">Lista de Productos</h1>

        <!-- Filtros -->
        <div class="mb-4 flex justify-between">
            <form action="{{ route('products.index') }}" method="GET" class="flex space-x-4">
                <input type="text" name="name" value="{{ request('name') }}" placeholder="Buscar por nombre" class="border border-gray-300 px-4 py-2 rounded-lg">

                <select name="category" class="border border-gray-300 px-4 py-2 rounded-lg">
                    <option value="">Seleccionar categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>

                <select name="supplier" class="border border-gray-300 px-4 py-2 rounded-lg">
                    <option value="">Seleccionar proveedor</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ request('supplier') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">Aplicar Filtros</button>
            </form>
        </div>

        <div class="flex justify-end mb-4">
            <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">Crear Producto</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Nombre</th>
                        <th class="border border-gray-300 px-4 py-2">Precio</th>
                        <th class="border border-gray-300 px-4 py-2">Stock</th>
                        <th class="border border-gray-300 px-4 py-2">Categoría</th>
                        <th class="border border-gray-300 px-4 py-2">Proveedores</th>
                        <th class="border border-gray-300 px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">Q{{ $product->price }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->stock }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->category->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @foreach ($product->suppliers as $supplier)
                                    <span class="bg-gray-500 text-white text-sm px-2 py-1 rounded-lg">{{ $supplier->name }}</span>
                                @endforeach
                            </td>
                            <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                <a href="{{ route('products.edit', $product) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg">Editar</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
