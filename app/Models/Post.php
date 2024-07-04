<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Carbon\Carbon;
// use \Storage;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;



    protected $fillable = ['title','content','date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
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
        $this->removeImage();
        $this->delete();
    }
    public function uploadImage($image)
    {
        if($image == null) { return; }

        $this->removeImage();
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }
    public function removeImage()
    {
       if ($this->image != null) {
            Storage::delete('uploads/' . $this->image);
        }
    }

    public function getImage()
    {   
        if($this->image == null) {
            return '/img/no-image.png';
        }
        return '/uploads/' . $this->image;
    }
 
    public function getDate()
    {
        return Carbon::createFromFormat('Y-m-d', $this->date)->format('F d, Y');
    }


    public function getCategoryId()
    {
        return $this->category != null ?  $this->category->id : null;
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
    public function getCategoryTitle()
    {
       return ($this->category !=null ) ? $this->category->title : 'Нет Категории';
    }
    // public function getTagsTitles()
    // {
    //    // code... 
    // }

    // public function setDateAttribute($value)
    // {
    //     Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
    //     dd($value);
    // }
    // мне ебаться не придется, так как type="data" уже изначально нормально хавает формат

    public function hasCategory($value='')
    {
        return $this->category != null ? true : false;
    }

    public function hasPrevious()
    {
        return self::where('id', '<', $this->id)->max('id');
    }
    public function getPrevious()
    {
        $postID = $this->hasPrevious();
        return self::find($postID);
    }
    public function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }
    public function getNext()
    {
        $postID = $this->hasNext();
        return self::find($postID);
    }
    public function related()
    {
        return self::all()->except($this->id);

    }
    public function getComments()
    {
        return $this->comments()->where('status', 1)->get();
    }

}
