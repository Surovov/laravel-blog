<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->hasOne(Post::class);
    }
    public function author()
    {
        return $this->hasOne(User::class);
    }

    public function allow()
    {
        $this->status = 1;
        $this->save();
    }
    public function dissalow()
    {
        $this->status = 0;
        $this->save();
    }
    public function toggleStatus($value)
    {
        if ($this->status == 0) {
            return $this->allow();
        }
        return $this->dissalow();
    }
    public function remove()
    {
        $this->delete();
    }
}
