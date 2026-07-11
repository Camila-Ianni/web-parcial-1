<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class UserManagementController extends Controller
{
    
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::with('orders')->latest()->get(),
        ]);
    }

    
    public function show(User $user): View
    {
        // Eager load purchases and orders with items
        $user->load(['purchases.product', 'orders.items.product']);

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    
    public function toggleRole(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors(['role' => 'No puedes cambiar tu propio rol de administrador.']);
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        return redirect()->route('admin.users.show', $user)->with('status', 'Rol de usuario actualizado correctamente.');
    }
}
