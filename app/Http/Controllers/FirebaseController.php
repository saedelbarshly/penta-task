<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    public function index()
    {
        return view('auth.firebase-login');
    }
    public function verifyPhone()
    {
        return view('auth.verify-phone');
    }


}
