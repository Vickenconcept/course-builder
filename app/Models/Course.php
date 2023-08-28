<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Library;
use App\Models\Lesson;
use App\Models\CourseSettings;
use App\Models\Scopes\courseRetriever;
use App\Models\Trait\CourseSluggable;

class Course extends Model
{
    use HasFactory, CourseSluggable;

    
    protected $fillable = [
        'title',
        'description',
        'slug',
        'list_id',
        'price'
    ];

    public function library()
    {
        return $this->hasOne(Library::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function courseSettings()
    {
        return $this->hasOne(CourseSettings::class);
    }
    
    public function user()
    {

        return $this->belongsToMany(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new courseRetriever);
    }
}
