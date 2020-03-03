<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class record extends Model
{
    protected $fillable = ['domain_id','type','ttl','priority','content'];

    public function domain()
    {
        return $this->belongsTo(domain::class);
    }
}
