<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Solo accesible para usuarios autenticados
    }

    // Mostrar el historial de transacciones en el inventario
    public function index()
    {
        $inventories = Inventory::with('product')->latest()->get();
        return view('inventories.index', compact('inventories'));
    }
}
