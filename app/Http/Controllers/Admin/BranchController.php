<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branchs = Admin::Orderby('id', 'desc')->where('type','branch')->get();
        return view('admin.branch.index',compact('branchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $filename = time().'.'.$request->file('image')->extension();
        $request->image->storeAs('uploads/branch', $filename, 'public');
        $filename = 'uploads/branch/'.$filename;

        Admin::create([
            'name' => $request->name,
            'username' =>$request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'type' => 'branch',
            'image' => $filename,
        ]);

        return redirect(route('branch.index'))->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/'.$admin->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/branch', $filename, 'public');
            $filename = 'uploads/branch/'.$filename;
        } else {
            $filename = $admin->image;
        }

        $admin->update([
            'name' => $request->name,
            'username' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'image' => $filename,
        ]);

        return redirect(route('branch.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
