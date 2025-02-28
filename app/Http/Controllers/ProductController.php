<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        // Crear la consulta inicial
        $products = Product::query()
            // Filtrar por nombre si el campo 'name' está presente
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            // Filtrar por categoría si el campo 'category' está presente
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            // Filtrar por proveedor si el campo 'supplier' está presente
            ->when($request->filled('supplier'), function ($query) use ($request) {
                $query->whereHas('suppliers', function ($query) use ($request) {
                    $query->where('supplier_id', $request->supplier);
                });
            })
            // Paginación
            ->paginate(10);

        // Pasar los productos, categorías y proveedores a la vista
        return view('products.index', compact('products', 'categories', 'suppliers'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'suppliers' => 'required|array',
            'suppliers.*' => 'exists:suppliers,id',
        ]);

        $product = Product::create($request->except('suppliers'));
        $product->suppliers()->sync($request->suppliers ?? []); // Usa sync para evitar errores

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|unique:products,name,' . $product->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'suppliers' => 'required|array',
            'suppliers.*' => 'exists:suppliers,id',
        ]);

        $product->update($request->except('suppliers'));
        $product->suppliers()->sync($request->suppliers ?? []); // Usa sync para manejar proveedores

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->suppliers()->detach(); // Desvincular proveedores antes de eliminar
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
