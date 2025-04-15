@extends('layout')

@section('content')
<h2>Livros</h2>
<a href="{{ route('livros.create') }}">Novo Livro</a>
<table>
    <tr>
        <th>Nome</th><th>Autor</th><th>Registro</th><th>Gênero</th><th>Situação</th><th>Ações</th>
    </tr>
    @foreach($livros as $l)
    <tr>
        <td>{{ $l->nome }}</td>
        <td>{{ $l->autor }}</td>
        <td>{{ $l->numero_registro }}</td>
        <td>{{ $l->genero }}</td>
        <td>{{ $l->situacao }}</td>
        <td>
            <a href="{{ route('livros.edit', $l) }}">Editar</a>
            <form method="POST" action="{{ route('livros.destroy', $l) }}" style="display:inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Excluir?')">Excluir</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
