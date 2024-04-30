<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Library;
use App\Models\Course;
use App\Models\Book;
use App\Models\Setting;
use App\Models\Reseller;
use App\Models\Courseresearch ;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Billable;

class User extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory, Billable;

    public $user;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    
    public function Library() {
        
        return $this->hasMany(Library::class);
    }

    public function resellers()
    {
        return $this->hasMany(Reseller::class);
    }

    public function ContentPlanner() {
        
        return $this->hasMany(ContentPlanner::class);
    }
    public function Book() {
        
        return $this->hasMany(Book::class);
    }
    public function courses() {
        
        return $this->belongsToMany(Course::class);
    }
    public function courseresearches() {
        
        return $this->hasMany(Courseresearch::class);
    }
    public function setting() {
        
        return $this->hasOne(Setting::class);
    }
    protected function createdAt(): Attribute
    {
        return Attribute::get(fn ($value) => Carbon::parse($value)->format('F j, Y, g:i A'));
    }

   
}
