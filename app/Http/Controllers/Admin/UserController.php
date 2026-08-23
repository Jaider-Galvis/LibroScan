<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.usuarios.index', compact('users'));
    }

    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', ['user' => $usuario]);
    }

    public function update(Request $request, User $usuario)
    {
        $validatedData = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'role'  => 'required|string|in:admin,student',
        ]);

        $usuario->update($validatedData);

        return redirect()
            ->route('admin.usuarios.index')
            ->with('success', '¡Usuario actualizado correctamente!');
    }
}