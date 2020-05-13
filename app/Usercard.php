<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usercard extends Model
{
    protected $fillable = [
        'user_id',
        'card_id',
        'brand',
        'last_digits',
        'holder_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
