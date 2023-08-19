<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\JobCompleted;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        
        $userStats = User::selectRaw('
            COUNT(*) AS total_users,
            SUM(CASE WHEN email_verified_at IS NOT NULL THEN 1 ELSE 0 END) as verified_users,
            SUM(CASE WHEN email_verified_at IS NULL THEN 1 ELSE 0 END) as unverified_users
        ')->first();

        $users = User::latest()->get();
        return view('dashboard', compact('users','userStats'));
    }

}
