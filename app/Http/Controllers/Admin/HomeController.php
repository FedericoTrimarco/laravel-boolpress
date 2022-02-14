<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendWelcomeEmail;

class HomeController extends Controller
{
    public function index(){

        // Test invio email
        
        // a. dati statici
        // Mail::to('account@mail.it')->send(new SendWelcomeEmail());

        // b. con auth
        // Mail::to(Auth::user()->email)->send(new SendWelcomeEmail());

        // c. con passaggio dati a classe  -> vista x email
        Mail::to(Auth::user()->email)->send(new SendWelcomeEmail(Auth::user()->name));

        return view('admin.home');
    }
}
