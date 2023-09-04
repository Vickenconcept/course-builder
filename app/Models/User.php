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
use App\Models\Courseresearch ;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory, Billable;

    public $user;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    // public function con(){
    //     $user = Auth::user();
    //     $settings = $user->setting;
        
    //     $paypalApiUsername = $settings->paypal_api_username;
    //     $paypalApiPassword = $settings->paypal_api_password;
    //     $paypalApiSecret = $settings->paypal_api_secret;
        
        
    //     // dd($paypalApiSecret);
    //     if ($settings) {
    //         $paypalApiUsername = $settings->paypal_api_username;
    //         $paypalApiPassword = $settings->paypal_api_password;
    //         $paypalApiSecret = $settings->paypal_api_secret;
        
    //         // Set these values in the configuration
    //         config([
    //             'paypal.username' => 'PAYPAL_SANDBOX_API_USERNAME=sb-ysibn26738051_api1.business.example.com',
    //             'paypal.password' => 'L7WZLSHNJLC5AYUP',
    //             'paypal.secret' => 'AB-hEOLcMHJX2X8wbiXNGwoPoxWyAddDyXPW.JMMIfgsOIjk.LBxvYS5',
    //         ]);
    //         // config([
    //         //     'paypal.username' => Crypt::decryptString($paypalApiUsername),
    //         //     'paypal.password' => $paypalApiPassword,
    //         //     'paypal.secret' =>  Crypt::decryptString($paypalApiSecret),
    //         // ]);
        
    //         // Now you can use these values in your PayPal configuration
    //     } else {
    //         // Handle the case where settings were not found for the user
    //         // You can set default values or take appropriate action
    //     }
    // }
}
