@extends('layout')
@section('content')
<h2>Novo Empréstimo</h2>
<form method="POST" action="{{ route('emprestimos.store') }}">
    @csrf

    <label>Usuário:
        <select name="user_id">
            @foreach($usuarios as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
            @endforeach
        </select>
    </label>

    <label>Livro:
        <select name="livro_id">
            @foreach($livros as $l)
                <option value="{{ $l->id }}">{{ $l->nome }}</option>
            @endforeach
        </select>
    </label>

    <label>Data de Devolução:
        <input type="date" name="data_devolucao">
    </label>

    <button type="submit">Salvar</button>
</form>
@endsection
