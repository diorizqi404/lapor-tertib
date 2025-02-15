<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ViolationCategory extends Model
{
    use Searchable, HasFactory;

    protected $guarded = [];

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
