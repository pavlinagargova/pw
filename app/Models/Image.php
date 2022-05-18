<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
    ];

    public function post() {
        return $this->belongsToMany(Post::class, 'post_image');
    }

    public function getPostAttribute() {
        return $this->post()->first();
    }
}
