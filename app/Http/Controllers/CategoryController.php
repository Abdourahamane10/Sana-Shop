<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory()
    {
        return view('admin.addCategory');
    }

    public function categories()
    {
        return view('admin.categories');
    }
}
