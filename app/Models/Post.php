<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory;
    use Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;



    protected $fillable = ['title','content']

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function author()
    {
        return $this->hasOne(User::class);
    }
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class, // Модель, с которой устанавливается связь
            'post_tags', // Имя промежуточной таблицы
            'post_id', // Внешний ключ для текущей модели (Post)
            'tag_id' // Внешний ключ для связанной модели (Tag)
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

    public static function add($fields)
    {
        $post = new static; // Создается новый экземпляр модели Post
        $post->fill($fields); // Массово присваиваются значения атрибутов из $fields
        $post->user_id = 1; // Устанавливается user_id (пока жестко заданный)
        $post->save(); // Сохраняется новый пост в базе данных
        return $post; // Возвращается созданный пост
    }

    public function edit($feilds)
    {
        $this->fill($fields);
        $this->save();
    }
    public function remove()
    {   
        Storage::delete('uploads/' . $this->image);
        $this->delete();
    }
    public function uploadImage($image)
    {
        if($image == null) { return; }

        Storage::delete('uploads/' . $this->image);
        $filename = str_random(10) . '.' . $image->extesion();
        $image->saveAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function getImage()
    {   
        if($this->image == null) {
            return '/img/no-image.png';
        }
        return '/uploads' . $this->image;
    }


    // Category & Tags
    public function setCategory($id)
    {
        if($id == null) {return;}

        $this->category_id = $id;
        $this->save();
    }
    public function setTags($ids)
    {
        if($ids == null) {return;}

        $this->tags()->sync($ids);
    }

    // Status

    public function setDraft()
    {
        $this->status = Post::IS_DRAFT;
        $this->save();
    }
    public function setPublic()
    {
        $this->status = Post::IS_PUBLIC;
        $this->save();
    }
    public function toggleStatus($value)
    {
        if($value = null)
        {
            $this->setDraft();
        }
        else
        {
            $this->setPublic();
        }
    }

    // Featured

    public function setFeatured()
    {
        $this->is_featured = 1;
        $this->save();
    }
    public function setStandart()
    {
        $this->is_featured = 0;
        $this->save();
    }
    public function toggleFeatured($value)
    {
        if($value = null)
        {
            $this->setStandart();
        }
        else
        {
            $this->setFeatured();
        }
    }


}
