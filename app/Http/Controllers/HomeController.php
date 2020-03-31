<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
Use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == User::ROLE_MANAGER) {
            return redirect('/manager/tickets');
        }else {
            return redirect('/user/tickets');
        }
    }
}
