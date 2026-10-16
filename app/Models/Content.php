<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = ['id'];

public function user() {
    return $this->belongsTo(User::class);
}

public function channel() {
    return $this->belongsTo(Channel::class);
}

public function checklists() {
    return $this->hasMany(ContentChecklist::class);
}

public function metrics() {
    return $this->hasMany(ContentMetric::class);
}
}
