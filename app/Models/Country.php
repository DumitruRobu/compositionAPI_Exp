<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = "countries";
    public function user(){
        return $this->hasMany(User::class, 'country_id', 'id');
    }
}
