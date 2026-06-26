<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
}
