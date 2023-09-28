<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'mailchimp_api_key',
        'mailchimp_prefix_key',
        'paypal_api_username',
        'paypal_api_password',
        'paypal_api_secret',
        'get_response_api_key',
        'mailer_api_key',
        'emailoctopus_api_key',
        'convert_api_key',
        'in_need',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
