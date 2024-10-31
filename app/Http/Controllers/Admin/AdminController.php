<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        if(Admin::count() == 0 ) {
            Admin::create([
                'name' => config('app.name'),
                'username' => 'admin',
                'password' => Hash::make(12345678),
            ]);
        }
    }

    function index()
    {
        return view('admin/index');
    }

    function login(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'username' => 'required',
        ]);

        $data = [
        	'username' => $request->username,
        	'password' => $request->password
        ];

        if (auth()->guard('admin')->attempt($data)) {
        	return redirect(route('dashboard'));
        }
        else {
        	return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
	{
	    auth()->guard('admin')->logout();
	    return redirect('admin');
	}
}
