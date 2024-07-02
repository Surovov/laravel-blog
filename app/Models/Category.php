<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function add($fields)
    {
        $category = new static; // Создается новый экземпляр модели Категории
        $category->fill($fields); // Массово присваиваются значения атрибутов из $fields
        $category->save(); // Сохраняется новый пост в базе данных
        return $category; // Возвращается созданная категория
    }

    public function edit($feilds)
    {
        $this->fill($fields);
        $this->save();
    }

}
