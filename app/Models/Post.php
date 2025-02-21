<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
   
    protected $fillable=[
        'user_id',
        'title',
        'cat_id',
        'description',
        'category',
        'date',
        'place',
        'cover'
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
