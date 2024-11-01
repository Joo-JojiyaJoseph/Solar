<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\LeadFormSubmission;
use App\Models\Admin\Admin;
use App\Models\Admin\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branchs = Admin::Orderby('id', 'desc')->where('type','branch')->get();
        return view('admin.leads.create',compact('branchs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'branch' => 'required',
            'customer_address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'service' => 'required|string',
        ]);

        Lead::create($validated + $request->only(['landmark', 'alternate_number', 'email', 'sub_service', 'comments']));
        $lead=
        [
        'branch' => $request->branch,
        'customer_name' => $request->customer_name,
        'customer_address' => $request->customer_address,
        'contact_number' => $request->contact_number,
        'alternate_number' => $request->alternate_number,
        'email' => $request->email,
        'service' => $request->service,
        'sub_service' => $request->sub_service,
        'landmark' => $request->landmark,
        'comments' => $request->comments,
           ];
        Mail::to('admin@example.com')->send(new LeadFormSubmission($lead));

        return redirect()->back()->with('success', 'Lead submitted successfully.');
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
        //
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
