<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livro extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'autor', 'numero_registro', 'situacao', 'genero'];

    public function emprestimos() {
        return $this->hasMany(Emprestimo::class);
    }
}
