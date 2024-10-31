<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $id = auth()->guard('admin')->user()->id;
        $admin = Admin::find($id);
        return view('admin/profile', compact('admin'));
    }

    public function store(Request $request)
    {
        $id = auth()->guard('admin')->user()->id;
        $admin = Admin::find($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/'.$admin->image);

            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/admin/', $filename, 'public');
            $filename = 'uploads/admin/'.$filename;
        } else {
            $filename = $admin->image;
        }

        $admin->update([
            'name' => $request->name,
            'username' => $request->username,
            'image' => $filename,
        ]);

        return redirect(route('profile.index'))->with('success', 'Profile updated successfully');
    }

    public function edit($id)
    {
        $id = auth()->guard('admin')->user()->id;
        $admin = Admin::find($id);
        return view('admin/password-change', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $id = auth()->guard('admin')->user()->id;
        $admin = Admin::find($id);

        if (Hash::check($request->current_password, $admin->password)) {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:8',
                'confirm_password' => 'min:8|required_with:password|same:password',
            ]);

            $admin->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect(route('profile.edit', $id))->with('success', 'Password changed successfully');
        }
        else {
            return redirect(route('profile.edit', $id))->with('error', 'Current passwor not matching');
        }
    }
}
