<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    
   

    public function content() {
        return $this->belongsToMany('App\Content');
    }
}
