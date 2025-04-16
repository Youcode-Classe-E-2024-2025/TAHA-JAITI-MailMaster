<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'name', 'status'];

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
}