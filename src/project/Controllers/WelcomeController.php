<?php

namespace Project\Controllers;


class WelcomeController extends Controller
{
    public function welcome ()
    {
        return view('welcome');
    }

}