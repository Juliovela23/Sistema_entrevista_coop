<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Roles;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Roles::all(); // Obtén todos los roles
        return view('auth.register', compact('roles')); // Pasa los roles a la vista
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    // Validar los campos del formulario, incluido el 'role_id'
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role_id' => ['required', 'exists:roles,id'],  // Validar que el rol existe en la tabla 'roles'
    ]);

    // Crear el usuario con el role_id
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role_id,  // Asignar el rol al usuario
    ]);

    // Activar el evento de registro de usuario
    event(new Registered($user));

    // Iniciar sesión automáticamente después del registro
    Auth::login($user);

    // Redirigir al usuario a la página de inicio
    return redirect(RouteServiceProvider::HOME);
}
}
