<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use APP\Models\Course;

class CourseIpAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip_address',
        'course_id'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);

    }
}
