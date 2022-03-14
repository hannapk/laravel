<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        flash('환영합니다');
        return view('home');
    }
}
