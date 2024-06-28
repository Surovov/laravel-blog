<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $fillable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(
            Post::class, // Модель, с которой устанавливается связь
            'post_tags', // Имя промежуточной таблицы
            'tag_id', // Внешний ключ для текущей модели (Tag)
            'post_id'// Внешний ключ для связанной модели (Post)
        );
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
