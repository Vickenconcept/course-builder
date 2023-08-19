<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Library;
use App\Models\Lesson;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'description',
        'slug'
    ];
    
    public function library()
    {
        return $this->hasOne(Library::class);
    }
    
    public function user() {

        return $this->belongsTo(User::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
