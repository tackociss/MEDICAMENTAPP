<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Acceuilcontroller extends Controller
{
    //
    public function index(){
        return view ('layout.template');
    }
}
