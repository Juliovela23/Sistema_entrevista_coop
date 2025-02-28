@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Registrar Venta</h1>

    <form action="{{ route('sales.store') }}" method="POST" class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="products" class="block text-gray-700 font-medium">Seleccionar Productos</label>
            <div id="product-fields" class="space-y-4">
                <div class="product-field flex space-x-4">
                    <select name="products[0][id]" class="w-2/3 px-4 py-2 border border-gray-300 rounded-lg" required>
                        <option value="">Selecciona un producto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - Q{{ $product->price }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="products[0][quantity]" class="w-1/3 px-4 py-2 border border-gray-300 rounded-lg" placeholder="Cantidad" required min="1">
                    <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg" onclick="addToCart(0)">Agregar</button>
                </div>
            </div>
            <button type="button" id="add-product" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Agregar otro producto</button>
        </div>

        <!-- Carrito de compras -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Carrito de Compras</h3>
            <table id="cart" class="w-full mt-4 table-auto border-collapse border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Producto</th>
                        <th class="border border-gray-300 px-4 py-2">Cantidad</th>
                        <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                        <th class="border border-gray-300 px-4 py-2">Acción</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <!-- Aquí se irán agregando los productos dinámicamente -->
                </tbody>
            </table>
        </div>

        <div class="mb-4">
            <label for="payment_method" class="block text-gray-700 font-medium">Método de Pago</label>
            <select name="payment_method" id="payment_method" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="transferencia">Transferencia</option>
                <option value="crédito">Crédito</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md mt-6">Registrar Venta</button>
    </form>

    <script>
        let productIndex = 1;

        // Función para agregar productos al carrito
        function addToCart(index) {
            const productSelect = document.querySelector(`select[name="products[${index}][id]"]`);
            const quantityInput = document.querySelector(`input[name="products[${index}][quantity]"]`);
            const cartItems = document.getElementById('cart-items');

            const productId = productSelect.value;
            const productName = productSelect.options[productSelect.selectedIndex].text;
            const productPrice = parseFloat(productSelect.options[productSelect.selectedIndex].getAttribute('data-price'));
            const quantity = parseInt(quantityInput.value);

            if (productId && quantity > 0) {
                const subtotal = (productPrice * quantity).toFixed(2);

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="border border-gray-300 px-4 py-2">${productName}</td>
                    <td class="border border-gray-300 px-4 py-2">${quantity}</td>
                    <td class="border border-gray-300 px-4 py-2">Q${subtotal}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <button type="button" class="text-red-600" onclick="removeProduct(this)">Eliminar</button>
                    </td>
                `;
                cartItems.appendChild(row);

                // Crear los campos ocultos para los productos
                const inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = `products[${productIndex}][id]`;
                inputId.value = productId;
                document.querySelector('form').appendChild(inputId);

                const inputQuantity = document.createElement('input');
                inputQuantity.type = 'hidden';
                inputQuantity.name = `products[${productIndex}][quantity]`;
                inputQuantity.value = quantity;
                document.querySelector('form').appendChild(inputQuantity);

                productIndex++;
            }
        }

        // Función para eliminar productos del carrito
        function removeProduct(button) {
            const row = button.closest('tr');
            row.remove();
        }

        // Agregar producto al carrito al seleccionar
        document.getElementById('add-product').addEventListener('click', function () {
            const productFields = document.getElementById('product-fields');
            const newProductField = document.createElement('div');
            newProductField.classList.add('product-field', 'flex', 'space-x-4');
            newProductField.innerHTML = `
                <select name="products[${productIndex}][id]" class="w-2/3 px-4 py-2 border border-gray-300 rounded-lg" required>
                    <option value="">Selecciona un producto</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} - Q{{ $product->price }}</option>
                    @endforeach
                </select>
                <input type="number" name="products[${productIndex}][quantity]" class="w-1/3 px-4 py-2 border border-gray-300 rounded-lg" placeholder="Cantidad" required min="1">
                <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg" onclick="addToCart(${productIndex})">Agregar</button>
            `;
            productFields.appendChild(newProductField);
            productIndex++;
        });
    </script>
@endsection
