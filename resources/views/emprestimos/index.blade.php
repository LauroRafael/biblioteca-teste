@extends('layout')
@section('content')
<h2>Empréstimos</h2>
<a href="{{ route('emprestimos.create') }}">Novo Empréstimo</a>
<table>
    <tr>
        <th>Usuário</th><th>Livro</th><th>Devolução</th><th>Status</th><th>Ações</th>
    </tr>
    @foreach($emprestimos as $e)
    <tr>
        <td>{{ $e->usuario->name }}</td>
        <td>{{ $e->livro->nome }}</td>
        <td>{{ $e->data_devolucao }}</td>
        <td>{{ $e->status }}</td>
        <td>
            @if($e->status !== 'Devolvido')
            <form action="{{ route('emprestimos.devolver', $e) }}" method="POST" style="display:inline">@csrf<button>Devolver</button></form>
            <form action="{{ route('emprestimos.atrasar', $e) }}" method="POST" style="display:inline">@csrf<button>Atrasar</button></form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection
