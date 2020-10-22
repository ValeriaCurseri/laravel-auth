<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'titolo', 'articolo', 'slug'
    ];

    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
