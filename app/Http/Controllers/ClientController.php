<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Client;
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
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        return back();
    }

    public function supprimerDuPanier($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return back();
    }

    public function paiement()
    {
        if (!Session::has('client')) {
            return view('client.login');
        }
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

    public function creerCompte(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|unique:clients', 'password' => 'required|min:8']);
        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));
        $client->save();
        return back()->with('status', 'Votre compte a été crée avec succès !!');
    }

    public function orders()
    {
        return view('admin.orders');
    }
}
