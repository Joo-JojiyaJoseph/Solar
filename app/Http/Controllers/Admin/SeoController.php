<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function __construct()
    {
        $pages = [
            'home', 'about', 'contact',
        ];

        if(Seo::count() == 0 ) {
            foreach($pages as $page) {
                Seo::create([
                    'page' => $page,
                    'title' => ucwords(str_replace('_', ' ', $page)).' Title',
                    'description' => ucwords(str_replace('_', ' ', $page)).' Page Description',
                    'keywords' => ucwords(str_replace('_', ' ', $page)).' Page Keywords',
                ]);
            }
        }
    }

    public function index()
    {
        $seo = Seo::Orderby('page', 'asc')->get();
        return view('admin.web.seo', compact('seo'));
    }

    public function update(Request $request, Seo $seo)
    {
        $filename = '';
        $request->session()->flash('error', 'Something went wrong please check your data');

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required',
        ]);

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'mimes:jpg,jpeg,png,gif,bmp|max:3072'
            ]);

            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/seo', $filename, 'public');
            $filename = 'uploads/seo/'. $filename;
        }
        else
        {
             $filename= $seo->image;
        }

        $data = $request->except('image');
        $data += ['image' => $filename];

        $seo->update($data);
        return redirect(route('seo.index'))->with('success', 'Seo Updated successfully');
    }
}
