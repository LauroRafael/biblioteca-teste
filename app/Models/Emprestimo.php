<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emprestimo extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'livro_id', 'data_devolucao', 'status'];

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function livro() {
        return $this->belongsTo(Livro::class, 'livro_id');
    }
}
