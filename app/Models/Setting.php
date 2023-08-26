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
    ];


    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
