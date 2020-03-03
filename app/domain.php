<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class domain extends Model
{
    protected $fillable = ['domain','last_update'];

    public function records()
    {
        return $this->hasMany(record::class);
    }

    
}
