<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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
    }
}
