<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\Trait\CourseSluggable;

class Lesson extends Model
{
    use HasFactory,CourseSluggable;
    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
