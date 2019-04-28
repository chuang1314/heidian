<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuccessController extends Controller
{
    public function SuccessIndex(){
        return view('paysuccess');
    }
}
