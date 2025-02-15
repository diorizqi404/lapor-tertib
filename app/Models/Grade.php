<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Grade extends Model
{   
    use HasFactory;

    protected $guarded = [];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}
