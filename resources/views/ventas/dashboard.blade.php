@extends('layouts.app')

@section('content')
<div class="flex h-screen">


    <div class="flex-1 bg-gray-100 p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">Bienvenido al Dashboard</h1>

        </div>
        <div class="grid grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Total Ventas</h3>
                <p class="text-3xl font-bold text-indigo-600">Q</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Productos en Inventario</h3>
                <p class="text-3xl font-bold text-indigo-600"></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Usuarios Activos</h3>
                <p class="text-3xl font-bold text-indigo-600"></p>
            </div>
        </div>

        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-gray-800">Acciones Rápidas</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Crear Venta -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Crear Venta</h3>
                <p class="text-sm text-gray-600 mb-4">Crea una venta en base a los productos existentes.</p>
                <a href="/sales/create" class="text-indigo-600 font-medium hover:text-indigo-800">Ir al formulario</a>
            </div>

            <!-- Ver Inventario -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ver Inventario</h3>
                <p class="text-sm text-gray-600 mb-4">Consulta y administra el inventario de productos.</p>
                <a href="/products" class="text-indigo-600 font-medium hover:text-indigo-800">Ver inventario</a>
            </div>
            <!-- Ver Ventas Realizadas -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ver Ventas Realizadas</h3>
                <p class="text-sm text-gray-600 mb-4">Consulta y muestra las ventas que se realizaron.</p>
                <a href="/sales" class="text-indigo-600 font-medium hover:text-indigo-800">Listar ventas</a>
            </div>
        </div>
    </div>
</div>
@endsection
