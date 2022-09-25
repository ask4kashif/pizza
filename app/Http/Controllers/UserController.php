<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the application welcome page
     */
    public function welcome()
    {
        return view('welcome');
    }
    /**
     * Show the application menu page
     *
     */
    public function menu()
    {
        return view('user.menu.index');
    }
    /**
     * Show the application Services page
     *
     */
    public function services()
    {
        return view('user.services.index');
    }
    /**
     * Show the application about page
     *
     */
    public function about()
    {
        return view('user.about.index');
    }
    /**
     * Show the application contact page
     *
     */
    public function contact()
    {
        return view('user.contact.index');
    }
}
