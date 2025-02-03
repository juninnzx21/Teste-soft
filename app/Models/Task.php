<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos
    protected $fillable = ['title', 'description', 'status', 'availability', 'category_id', 'user_id'];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com a categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
