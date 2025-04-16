<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['newsletter_id', 'status', 'sent_at'];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class);
    }
}
