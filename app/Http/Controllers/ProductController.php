<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function addProduct()
    {
        $categories = Category::all()->pluck('category_name', 'category_name');
        return view('admin.addProduct')->with('categories', $categories);
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products')->with('products', $products);
    }

    public function saveProduct(Request $request)
    {
        $this->validate($request, ['product_name' => 'Required', 'product_price' => 'Required', 'product_category' => 'Required', 'product_image' => 'image|nullable|max:1999']);
        if ($request->file('product_image')) {
            //nom du fichier avec extension
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            //nom du fichier sans extension
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //extension du fichier
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //nom du fichier dans le store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            //upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noImage.jpg';
        }
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
        $product->product_image = $fileNameToStore;
        $product->status = 1;
        $product->save();

        return back()->with('status', 'Le product ' . $product->product_name . ' a été ajouté avec succès !!');
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        $categories = Category::all()->pluck('category_name', 'category_name');
        return view('admin.editProduct')->with('product', $product)->with('categories', $categories);
    }

    public function updateProduct(Request $request)
    {
        $this->validate($request, ['product_name' => 'Required', 'product_price' => 'Required', 'product_category' => 'Required', 'product_image' => 'image|nullable|max:1999']);
        $product = Product::find($request->input('id'));
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');

        if ($request->hasFile('product_image')) {
            //nom du fichier avec extension
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            //nom du fichier sans extension
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //extension du fichier
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //nom du fichier dans le store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            //upload image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
            //On vérifie si l'image du produit n'est pas l'image par defaut et on la supprime dans le storage
            if ($product->product_image != 'noImage.jpg') {
                Storage::delete('public/product_images/' . $product->product_image);
            }
            $product->product_image = $fileNameToStore;
        }

        $product->update();
        return redirect('/products')->with('status', "Le produit " . $product->product_name . " a été mis à jour avec succès !!");
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product->product_image != 'noImage.php') {
            Storage::delete('public/product_images/' . $product->product_image);
        }
        $product->delete();
        return back()->with('status', 'Le produit ' . $product->product_name . ' a été supprimé avec succès !!');
    }

    public function activerProduct($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        return back();
    }

    public function desactiverProduct($id)
    {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
        return back();
    }
}
