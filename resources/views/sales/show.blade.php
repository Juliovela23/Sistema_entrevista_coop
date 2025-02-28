@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Detalles de la Venta</h1>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Venta #{{ $sale->id }}</h2>
        <p><strong>Fecha:</strong> {{ $sale->created_at }}</p>
        <p><strong>Total:</strong> ${{ $sale->total }}</p>
        <p><strong>Método de Pago:</strong> {{ ucfirst($sale->payment_method) }}</p>

        <h3 class="text-xl font-semibold mt-6">Productos Vendidos</h3>
        <table class="w-full table-auto border-collapse border border-gray-300 shadow-lg rounded-lg mt-4">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Producto</th>
                    <th class="border border-gray-300 px-4 py-2">Cantidad</th>
                    <th class="border border-gray-300 px-4 py-2">Precio</th>
                    <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->saleItems as $item)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->product->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border border-gray-300 px-4 py-2">Q{{ $item->price }}</td>
                        <td class="border border-gray-300 px-4 py-2">Q{{ $item->subtotal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
