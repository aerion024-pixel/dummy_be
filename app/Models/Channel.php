<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = ['id'];

public function user() {
    return $this->belongsTo(User::class);
}

public function contents() {
    return $this->hasMany(Content::class);
}
}
