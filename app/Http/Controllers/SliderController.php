<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function addSlider()
    {
        return view('admin.addSlider');
    }

    public function sliders()
    {
        $sliders = Slider::all();
        return view('admin.sliders')->with('sliders', $sliders);
    }

    public function saveSlider(Request $request)
    {
        $this->validate($request, ['description1' => 'Required', 'description2' => 'Required', 'slider_image' => 'image|required|max:1999']);

        //nom du fichier avec extension
        $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
        //nom du fichier sans extension
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //extension du fichier
        $extension = $request->file('slider_image')->getClientOriginalExtension();
        //nom du fichier dans le store
        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
        //upload image
        $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

        $slider = new Slider();
        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        $slider->slider_image = $fileNameToStore;
        $slider->status = 1;
        $slider->save();
        return back()->with('status', 'Le slider a été enregistré avec succès !!');
    }
}
