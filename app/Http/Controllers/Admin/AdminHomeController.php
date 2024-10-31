<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\CouponCode;
use App\Models\Admin\Product;
use App\Models\Admin\Size;
use App\Models\Admin\SubCategory;
use App\Models\Review;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\Admin\Game;

class AdminHomeController extends Controller
{
    function index($home = null)
    {
        if($home == '') {
            $count = [

            ];
            return view('admin.home-web', compact('count'));
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
