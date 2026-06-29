<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class UserManagementController
 *
 * Handles admin panel user listing and detailed view.
 */
class UserManagementController extends Controller
{
    /**
     * Display a listing of the registered users.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->latest()->get(),
        ]);
    }

    /**
     * Display the specified user's details and purchased services.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        // Eager load purchases and their corresponding products
        $user->load(['purchases.product']);

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Toggle the administrator role for the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
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
