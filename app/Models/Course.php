<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Library;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['topic','overview'];
    
    public function library()
    {
        return $this->hasOne(Library::class);
    }
    
    public function user() {

        return $this->belongsTo(User::class);
    }
}
