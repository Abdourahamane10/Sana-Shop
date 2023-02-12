<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function ajouterAuPanier($id)
    {
        $product = Product::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return back();
    }

    public function panier()
    {
        if (!Session::has('cart')) {
            return redirect('/cart');
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        return view('client.panier', ['products' => $cart->items]);
    }

    public function modifierQuantite(Request $request, $id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQty($request->id, $request->quantity);
        Session::put('cart', $cart);

        return back();
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
