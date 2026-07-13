<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        $user = auth()->user();
        $user->load(['orders.items.product']);

        return view('profile.show', [
            'user' => $user,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El formato de email no es válido.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'profile_image.image' => 'El archivo debe ser una imagen.',
            'profile_image.max' => 'La imagen no debe pesar más de 2MB.',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/profiles');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $filename);
            
            if ($user->profile_image) {
                $oldImagePath = public_path($user->profile_image);
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
            
            $user->profile_image = 'uploads/profiles/' . $filename;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.show')->with('status', 'Perfil actualizado exitosamente.');
    }
}
