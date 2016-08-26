<?php

namespace App\Http\Controllers\Starter\Auth;

use Input;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{



    public function login2()
    {

        $returnURL = Input::get('returnURL');
        $title = "Login";
        $task = "docs";
        return View::make('starter/auth/login2',compact('returnURL'))->with('title', $title);

    }


    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {

                $email = Input::get('email');
        $password = Input::get('password');
        $returnURL = Input::get('returnURL');

        
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            // return redirect()->intended('dashboard');
             return redirect($returnURL);
        }
    }
}