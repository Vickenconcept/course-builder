<?php

namespace App\Models;

use App\Models\Scopes\courseRetriever;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Courseresearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'category',
        'rating',
        'subtitle',
        'isbn',
        'infolink',
        'pages',
    ];

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new courseRetriever);
    }
}
