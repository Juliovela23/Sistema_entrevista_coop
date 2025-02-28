@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Crear Proveedor</h1>

    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Nombre</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nombre del proveedor" required>
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contact" class="block text-gray-700 font-medium">Persona de Contacto</label>
                <input type="text" id="contact" name="contact" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Persona de contacto">
                @error('contact')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium">Teléfono</label>
                <input type="text" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Teléfono del proveedor">
                @error('phone')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Correo electrónico del proveedor">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-medium">Dirección</label>
                <textarea id="address" name="address" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Dirección del proveedor" rows="4"></textarea>
                @error('address')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md">Guardar Proveedor</button>
            </div>
        </form>
    </div>
@endsection
