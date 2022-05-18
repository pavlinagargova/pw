<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function image(){
       return $this->hasOne(Image::class);
    }
}
