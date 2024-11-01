<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Lead;

class AdminHomeController extends Controller
{
    function index($home = null)
    {
        if($home == '') {
            $count = [
                'total' => Lead::count(),
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
