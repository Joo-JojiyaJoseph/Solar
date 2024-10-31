<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::Orderby('id', 'desc')->get();
 
        return view('admin.web.testimonial')->with('testimonials', $testimonial );
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'quote' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);
 
        $filename = time().'.'.$request->file('image')->extension();
        $request->image->storeAs('uploads/testimonial', $filename, 'public');
        $filename = 'uploads/testimonial/'.$filename;

        Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'quote' => $request->quote,
            'image' => $filename,
        ]);
   
        return redirect(route('testimonial.index'))->with('success', 'Added Successfully');
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::find($id);

        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'quote' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/'.$testimonial->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/testimonial', $filename, 'public');
            $filename = 'uploads/testimonial/'.$filename;
        } else {
            $filename = $testimonial->image;
        }

        $testimonial->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'quote' => $request->quote,
            'image' => $filename,
        ]);

        return redirect(route('testimonial.index'))->with('success', 'Updated Successfully');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);

        Storage::delete('/public/'.$testimonial->image);
        Testimonial::destroy($testimonial->id);

        return redirect(route('testimonial.index'))->with('success', 'Deleted Successfully');
    }
}
