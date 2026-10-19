<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentMetric extends Model
{
    use HasFactory;

    protected $table = "content_metrics";

    protected $guarded = ["id"];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}