<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create() {
        return view('usuarios.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'numero_cadastro' => 'required|unique:users',
        ]);

        User::create($request->only(['name', 'email', 'numero_cadastro']));
        return redirect()->route('usuarios.index');
    }

    public function edit(User $usuario) {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$usuario->id,
            'numero_cadastro' => 'required|unique:users,numero_cadastro,'.$usuario->id,
        ]);

        $usuario->update($request->only(['name', 'email', 'numero_cadastro']));
        return redirect()->route('usuarios.index');
    }

    public function destroy(User $usuario) {
        $usuario->delete();
        return redirect()->route('usuarios.index');
    }
}
