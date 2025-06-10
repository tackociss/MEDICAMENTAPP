<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class settingControler extends Controller
{
    public function setting()
    {
        return view('parametre.para');
    }
}
