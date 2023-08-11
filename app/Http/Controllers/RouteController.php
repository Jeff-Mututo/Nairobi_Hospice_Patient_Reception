<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    // Load the welcome page
    public function welcome(){
        return view('welcome');
    }

    public function checkUserType(){
        // Check if the user has been authenticated
        if(Auth::id()){
            // Get the type of the user
            $user_type = Auth()->user()->user_type;

            // Redirect to respective route otherwise go back
            if($user_type == 'user'){
                return redirect('/dashboard');
            } else if($user_type == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/');
            }
        }
    }
}