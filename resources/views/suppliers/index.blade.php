@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 text-center mb-6">Administrar Proveedores</h1>

    <div class="flex justify-end mb-4">
        <a href="{{ route('suppliers.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">Crear Proveedor</a>
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
            @foreach ($suppliers as $supplier)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $supplier->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-lg">Editar</a>
                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST">
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
