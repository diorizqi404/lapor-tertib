<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Violation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function violationCategory()
    {
        return $this->belongsTo(ViolationCategory::class);
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($violation) {
        $violation->teacher_name = $violation->teacher->name ?? 'Unknown';
        $violation->violation_category_name = $violation->ViolationCategory->name ?? 'Unknown';
    });

    static::updating(function ($violation) {
        $violation->teacher_name = $violation->teacher->name ?? 'Unknown';
        $violation->violation_category_name = $violation->ViolationCategory->name ?? 'Unknown';
    });
}
}
