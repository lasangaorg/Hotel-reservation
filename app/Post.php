<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    public function postImages(){
        return $this->hasMany(PostImage::class);
    }
}
