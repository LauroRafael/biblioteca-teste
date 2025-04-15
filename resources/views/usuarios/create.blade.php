@extends('layout')
@section('content')
<h2>{{ isset($usuario) ? 'Editar' : 'Novo' }} Usuário</h2>

<form method="POST" action="{{ isset($usuario) ? route('usuarios.update', $usuario) : route('usuarios.store') }}">
    @csrf
    @if(isset($usuario)) @method('PUT') @endif

    <label>Nome: <input name="name" value="{{ old('name', $usuario->name ?? '') }}"></label>
    <label>Email: <input name="email" value="{{ old('email', $usuario->email ?? '') }}"></label>
    <label>Número Cadastro: <input name="numero_cadastro" value="{{ old('numero_cadastro', $usuario->numero_cadastro ?? '') }}"></label>

    <button type="submit">Salvar</button>
</form>
@endsection
