@extends('layout')

@section('content')
<h2>Usuários</h2>
<a href="{{ route('usuarios.create') }}">Novo Usuário</a>
<table>
    <tr>
        <th>Nome</th><th>Email</th><th>Número</th><th>Ações</th>
    </tr>
    @foreach($usuarios as $u)
    <tr>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->numero_cadastro }}</td>
        <td>
            <a href="{{ route('usuarios.edit', $u) }}">Editar</a>
            <form method="POST" action="{{ route('usuarios.destroy', $u) }}" style="display:inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Excluir?')">Excluir</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
