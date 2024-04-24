<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(){
        return view('admin.subscribe');
    }

    public function updateSubscription(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        $user->subscribed = '1';
        $user->update();

        return response()->json(['message' => 'Subscription updated successfully']);
    }
}
