<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class CategoryController extends Controller
{
    public function addCategory()
    {
        return view('admin.addCategory');
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories')->with('categories', $categories);
    }

    public function saveCategory(Request $request)
    {
        $this->validate($request, ['category_name' => 'Required|unique:categories']);
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();
        return back()->with('status', 'La catégorie ' . $category->category_name . ' a été ajouté avec succès !!');
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('admin.editCategory')->with('category', $category);
    }

    public function updateCategory(Request $request)
    {
        $this->validate($request, ['category_name' => 'Required']);
        $category = Category::find($request->input('id'));
        $category->category_name = $request->input('category_name');
        $category->update();
        return redirect('/categories')->with('status', 'La catégorie ' . $category->category_name . ' a été mise à jour avec succès !!');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back()->with('status', 'La catégorie ' . $category->category_name . ' a été supprimée avec succès !!');
    }
}
