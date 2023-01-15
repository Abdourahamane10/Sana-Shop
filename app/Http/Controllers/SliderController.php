<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function addSlider()
    {
        return view('admin.addSlider');
    }
}
