<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    public function verifyPhone()
    {
        return view('auth.verify-phone');
    }

    public function verifyCode(){
        $user = auth()->user();
        $user->phone_verified_at = now();
        $user->save();
        return redirect()->route('dashboard');
    }
}
