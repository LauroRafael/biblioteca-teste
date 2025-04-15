<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index() {
        $livros = Livro::all();
        return view('livros.index', compact('livros'));
    }

    public function create() {
        $generos = ['Ficção', 'Romance', 'Fantasia', 'Aventura'];
        return view('livros.create', compact('generos'));
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required',
            'autor' => 'required',
            'numero_registro' => 'required|unique:livros',
            'situacao' => 'required|in:Disponível,Emprestado',
            'genero' => 'required'
        ]);

        Livro::create($request->all());
        return redirect()->route('livros.index');
    }

    public function edit(Livro $livro) {
        $generos = ['Ficção', 'Romance', 'Fantasia', 'Aventura'];
        return view('livros.edit', compact('livro', 'generos'));
    }

    public function update(Request $request, Livro $livro) {
        $request->validate([
            'nome' => 'required',
            'autor' => 'required',
            'numero_registro' => 'required|unique:livros,numero_registro,' . $livro->id,
            'situacao' => 'required|in:Disponível,Emprestado',
            'genero' => 'required'
        ]);

        $livro->update($request->all());
        return redirect()->route('livros.index');
    }

    public function destroy(Livro $livro) {
        $livro->delete();
        return redirect()->route('livros.index');
    }
}
