<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'name' => 'aaron',
            'greeting' => 'Hello',
            'items' => ['apple', 'banana', 'tomato']
        ]);
    }
}