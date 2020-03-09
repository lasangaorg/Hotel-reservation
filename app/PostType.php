<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    public function Types(){
        return [
                'House' => 'House',
                'Flat' => 'Flat',
                'Hotel' => 'Hotel',
                'Villa' => 'Villa'
        ];
    }
}
