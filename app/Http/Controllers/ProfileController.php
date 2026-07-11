<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Class ProfileController
 *
 * Handles viewing and editing personal user data and viewing purchase history.
 *
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile and order history.
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        // Eager load order details
        $user->load(['orders.items.product']);

        return view('profile.show', [
            'user' => $user,
        ]);
    }

    /**
     * Update the authenticated user's personal details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El formato de email no es válido.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.show')->with('status', 'Perfil actualizado exitosamente.');
    }
}
