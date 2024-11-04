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

            $id = auth()->guard('admin')->user()->id;
            $user = Admin::find($id);

            if ($user->type=="branch" ) {
                $total = Lead::where('branch',$user->id)->orderBy('id', 'desc')->count();
                $new = Lead::where('branch',$user->id)->where('status','new')->count();
                $pending = Lead::where('branch',$user->id)->where('status','pending')->count();
                $working = Lead::where('branch',$user->id)->where('status','working')->count();
                $completed = Lead::where('branch',$user->id)->where('status','completed')->count();
            }
            elseif ($user->type=="technician" ) {
                $total = Lead::where('technician',$user->id)->orderBy('id', 'desc')->count();
                $new = Lead::where('technician',$user->id)->where('status','new')->count();
                $pending = Lead::where('technician',$user->id)->where('status','pending')->count();
                $working = Lead::where('technician',$user->id)->where('status','working')->count();
                $completed = Lead::where('technician',$user->id)->where('status','completed')->count();
            }
            else{
            $total = Lead::orderBy('id', 'desc')->count();
            $new = Lead::where('status','new')->count();
            $pending = Lead::where('status','pending')->count();
            $working = Lead::where('status','working')->count();
            $completed = Lead::where('status','completed')->count();
            }


            $count = [
                'total' => $total,
                'new' => $new,
                'pending' => $pending,
                'working' => $working,
                'completed' =>  $completed,
                'branch' => count(Admin::where('type','branch')->get()),
                'technician' => count(Admin::where('type','technician')->get()),

            ];


            return view('admin.home', compact('count','user'));
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
