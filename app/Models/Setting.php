<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    protected $casts = [
        'message_template' => 'array',
    ];
}
