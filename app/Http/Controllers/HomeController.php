<?php

namespace Restaurant\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
