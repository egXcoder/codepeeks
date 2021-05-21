<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutorial extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }
}
