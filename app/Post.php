<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $fillable = [
        'name', 'address', 'location', 'description', 'rent', 'beds', 'type', 'user_id'
    ];

    public function postImages(){
        return $this->hasMany(PostImage::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
