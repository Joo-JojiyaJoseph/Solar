<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use App\Models\Admin\Slider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

class HomeController extends Controller
{
    use WithPagination;
    public function index()
    {
        $sliders = Slider::Orderby('id', 'desc')->get();
        return view('index',compact('sliders'));
    }
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function contactPost(Request $request)
    {
        $subject = 'Contact Enquiry';
        $message = 'Name : '.$request->name. '<br>Email : '.$request->email. '<br>Phone : '.$request->phone. '<br>Message : '.$request->message;
        Mail::to('')->send(new Contact('',$message, $subject));
        return redirect(route('contact'))->with('status', 'Contact Enquiry  Successfully Submitted');
    }


}
