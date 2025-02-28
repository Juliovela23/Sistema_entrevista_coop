@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Historial de Transacciones en Inventario</h1>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-300 shadow-lg rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Producto</th>
                    <th class="border border-gray-300 px-4 py-2">Cantidad Antes</th>
                    <th class="border border-gray-300 px-4 py-2">Cantidad Después</th>
                    <th class="border border-gray-300 px-4 py-2">Razón del Cambio</th>
                    <th class="border border-gray-300 px-4 py-2">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $inventory)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ $inventory->product->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $inventory->stock_before }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $inventory->stock_after }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($inventory->change_reason) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $inventory->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
