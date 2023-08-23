<?php

namespace App\Models;

use App\Models\Scopes\courseRetriever;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Book extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'rating',
        'author',
        'pages',
        'infolink',
        'published_date',
    ];

    public function user() {

        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new courseRetriever);
        
    }
}
