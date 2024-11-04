<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Lead;

class AdminHomeController extends Controller
{
    function index($home = null)
    {
        if($home == '') {
            $count = [
                'total' => Lead::count(),
                'new' => count(Lead::where('status','new')->get()),
                'pending' => count(Lead::where('status','pending')->get()),
                'working' => count(Lead::where('status','working')->get()),
                'completed' => count(Lead::where('status','completed')->get()),
                'branch' => count(Admin::where('type','branch')->get()),
                'technician' => count(Admin::where('type','technician')->get()),

            ];
            return view('admin.home', compact('count'));
        }
        if($home == 'web') {
            $count = [

            ];
            return view('admin.home-web', compact('count'));
        }


    }

    function home()
    {
        return view('admin.home');
    }
    function orders()
    {
        return view('admin.order.order');
    }
}
