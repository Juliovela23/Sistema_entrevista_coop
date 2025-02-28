<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Solo accesible para usuarios autenticados
    }

    // Mostrar formulario de venta
    public function create()
    {
        $products = Product::where('is_active', true)->get(); // Obtener productos activos
        return view('sales.create', compact('products'));
    }

    // Registrar una nueva venta
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:efectivo,tarjeta,transferencia,crédito',
        ]);

        // Calcular el total de la venta
        $total = 0;
        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            $total += $product->price * $productData['quantity'];
        }

        // Crear la venta
        $sale = Sale::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'payment_method' => $request->payment_method,
        ]);

        // Registrar los productos vendidos y actualizar inventario
        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            $quantity = $productData['quantity'];

            // Crear un detalle de la venta (productos vendidos)
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $product->price * $quantity,
            ]);

            // Actualizar inventario
            $product->stock -= $quantity;
            $product->save();

            // Registrar el cambio en el inventario
            Inventory::create([
                'product_id' => $product->id,
                'stock_before' => $product->stock + $quantity,
                'stock_after' => $product->stock,
                'change_reason' => 'venta',
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Venta registrada con éxito.');
    }


    public function index()
    {
        $sales = Sale::with('saleItems.product')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function show($id)
    {

        $sale = Sale::with('saleItems.product')->findOrFail($id);

        return view('sales.show', compact('sale'));
    }
}
