<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentChecklist extends Model
{
    protected $guarded = ['id'];

public function content() {
    return $this->belongsTo(Content::class);
}
}
