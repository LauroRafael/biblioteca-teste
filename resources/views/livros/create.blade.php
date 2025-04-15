@extends('layout')
@section('content')
<h2>{{ isset($livro) ? 'Editar' : 'Novo' }} Livro</h2>

<form method="POST" action="{{ isset($livro) ? route('livros.update', $livro) : route('livros.store') }}">
    @csrf
    @if(isset($livro)) @method('PUT') @endif

    <label>Nome: <input name="nome" value="{{ old('nome', $livro->nome ?? '') }}"></label>
    <label>Autor: <input name="autor" value="{{ old('autor', $livro->autor ?? '') }}"></label>
    <label>Nº Registro: <input name="numero_registro" value="{{ old('numero_registro', $livro->numero_registro ?? '') }}"></label>
    <label>Gênero:
        <select name="genero">
            @foreach(['Ficção', 'Romance', 'Fantasia', 'Aventura'] as $genero)
                <option value="{{ $genero }}" @if(old('genero', $livro->genero ?? '') == $genero) selected @endif>{{ $genero }}</option>
            @endforeach
        </select>
    </label>
    <label>Situação:
        <select name="situacao">
            <option value="Disponível" {{ old('situacao', $livro->situacao ?? '') == 'Disponível' ? 'selected' : '' }}>Disponível</option>
            <option value="Emprestado" {{ old('situacao', $livro->situacao ?? '') == 'Emprestado' ? 'selected' : '' }}>Emprestado</option>
        </select>
    </label>

    <button type="submit">Salvar</button>
</form>
@endsection
