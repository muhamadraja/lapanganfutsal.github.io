<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return auth()->user()->role === 'admin'
            ? view('admin.dashboard')
            : view('tamu.dashboard');
    }
}
