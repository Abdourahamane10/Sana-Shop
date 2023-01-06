<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function home()
    {
        return view('client.home');
    }

    public function shop()
    {
        return view('client.shop');
    }

    public function panier()
    {
        return view('client.panier');
    }

    public function paiement()
    {
        return view('client.paiement');
    }
}
