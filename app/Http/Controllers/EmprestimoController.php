<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Emprestimo;
use App\Models\Livro;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::with(['usuario', 'livro'])->get();
        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create()
    {
        $usuarios = User::all();
        $livros = Livro::where('situacao', 'Disponível')->get();
        return view('emprestimos.create', compact('usuarios', 'livros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'livro_id' => 'required|exists:livros,id',
            'data_devolucao' => 'required|date',
        ]);

        Emprestimo::create([
            'user_id' => $request->user_id,
            'livro_id' => $request->livro_id,
            'data_devolucao' => $request->data_devolucao,
            'status' => 'Em Andamento',
        ]);

        $livro = Livro::find($request->livro_id);
        $livro->situacao = 'Emprestado';
        $livro->save();

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo registrado com sucesso!');
    }

    public function edit(Emprestimo $emprestimo)
    {
        $usuarios = User::all();
        $livros = Livro::all();
        return view('emprestimos.edit', compact('emprestimo', 'usuarios', 'livros'));
    }

    public function update(Request $request, Emprestimo $emprestimo)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'livro_id' => 'required|exists:livros,id',
            'data_devolucao' => 'required|date',
            'status' => 'required|string',
        ]);

        $emprestimo->update($request->all());

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo atualizado com sucesso!');
    }

    public function destroy(Emprestimo $emprestimo)
    {
        $livro = $emprestimo->livro;
        $livro->situacao = 'Disponível';
        $livro->save();

        $emprestimo->delete();

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo removido com sucesso!');
    }

    public function marcarDevolvido(Emprestimo $emprestimo)
    {
        $emprestimo->status = 'Devolvido';
        $emprestimo->save();

        $livro = $emprestimo->livro;
        $livro->situacao = 'Disponível';
        $livro->save();

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo marcado como devolvido.');
    }

    public function marcarAtrasado(Emprestimo $emprestimo)
    {
        $emprestimo->status = 'Atrasado';
        $emprestimo->save();

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo marcado como atrasado.');
    }
}
