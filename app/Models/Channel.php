<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory
    protected $table = "channels"

    protected $fillable = [
    "user_id", "platform", "channel_name", "channel_url", "subcriber_count",
    ]

public function user() {
    return $this->belongsTo(User::class);
}

public function contents() {
    return $this->hasMany(Content::class);
}
}
