<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class CourseSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'free_lessons_count'
    ];


    public function course()
    {

        return $this->belongsTo(Course::class);
    }
}
