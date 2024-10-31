<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::Orderby('id', 'desc')->get();
        return view('admin.web.slider')->with('sliders', $slider );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'toptitle' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'

         ]);

         $filename = time().'.'.$request->file('image')->extension();
         $request->image->storeAs('uploads/slider', $filename, 'public');

         $data = [
             'title' => $request->title,
             'subtitle' => $request->subtitle,
             'toptitle' => $request->toptitle,
             'image' => $filename,
         ];
        Slider::create($data);

         return Back()->with('success', 'added');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $slider = Slider::find($id);
        $request->validate([
            'title' => 'required',

         ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/uploads/slider/'.$slider->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/slider', $filename, 'public');
        } else {
            $filename = $slider->image;
        }

        $data = [
            'title' => $request->title,
            'toptitle' => $request->toptitle,
            'subtitle' => $request->subtitle,
            'image' => $filename,
        ];


        $slider->update($data);
        return Back()->with('success', 'Updated Sucessfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider= Slider::findOrFail($id);
        $slider->delete();

        return redirect(route('slider.index'))->with('success', 'Deleted Successfully');
    }
}
