@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Historial de Ventas</h1>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-300 shadow-lg rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Fecha</th>
                    <th class="border border-gray-300 px-4 py-2">Total</th>
                    <th class="border border-gray-300 px-4 py-2">Método de Pago</th>
                    <th class="border border-gray-300 px-4 py-2">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $sale->created_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">Q{{ $sale->total }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($sale->payment_method) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('sales.show', $sale) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
