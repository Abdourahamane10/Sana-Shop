<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function home()
    {
        $products = Product::all()->where('status', '=', 1);
        $sliders = Slider::all()->where('status', '=', 1);
        return view('client.home')->with('products', $products)->with('sliders', $sliders);
    }

    public function shop()
    {
        $products = Product::all()->where('status', '=', 1);
        $categories = Category::all();
        return view('client.shop')->with('products', $products)->with('categories', $categories);
    }

    public function panier()
    {
        return view('client.panier');
    }

    public function paiement()
    {
        return view('client.paiement');
    }

    public function login()
    {
        return view('client.login');
    }

    public function signup()
    {
        return view('client.signup');
    }

    public function orders()
    {
        return view('admin.orders');
    }
}
