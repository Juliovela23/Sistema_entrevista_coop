<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard según el rol del usuario.
     */
    public function index()
    {
        $user = auth()->user(); // Obtiene el usuario autenticado

        if ($user->hasRole('Admin')) {
            return view('admin.dashboard');
        } elseif ($user->hasRole('Vendedor')) {
            return view('ventas.dashboard');
        } else {
            return view('cliente.dashboard');
        }
    }
}
