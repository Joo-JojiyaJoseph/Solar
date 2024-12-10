<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\LeadFormSubmission;
use App\Models\Admin\Admin;
use App\Models\Admin\Lead;
use App\Models\Admin\Service;
use App\Models\Admin\SubService;
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
        $services = Service::Orderby('id', 'desc')->get();
        $branchs = Admin::Orderby('id', 'desc')->where('type','branch')->get();
        return view('admin.leads.create',compact('branchs','services'));
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
            'lead_date' => 'required',
            'branch' => 'required',
            'customer_address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:10|min:10|unique:leads,contact_number',
            'service' => 'required|string',
            'referance' => 'required|string',
        ]);

        Lead::create($validated + $request->only(['landmark', 'alternate_number', 'email', 'sub_service', 'comments','enterd_by']));
        $lead=
        [
        'lead_date'=>$request->lead_date,
        'branch' => $request->branch,
        'customer_name' => $request->customer_name,
        'customer_address' => $request->customer_address,
        'contact_number' => $request->contact_number,
        'alternate_number' => $request->alternate_number,
        'alternate_number1' => $request->alternate_number1,
        'enterd_by' => $request->enterd_by,
        'email' => $request->email,
        'service' => $request->service,
        'landmark' => $request->landmark,
        'comments' => $request->comments,
        'referance'=>$request->referance
           ];
        // Mail::to('admin@example.com')->send(new LeadFormSubmission($lead));

        return redirect()->back()->with('success', 'Lead submitted successfully.');
    }


    public function checkContactNumber(Request $request)
    {
        // Validate the contact number query parameter
        $validatedData = $request->validate([
            'contact_number' => 'required|numeric', // Add necessary validation for the contact number
        ]);

        // Check if the contact number exists in the database
        $isTaken = Lead::where('contact_number', $request->contact_number)->exists();

        // Return a JSON response with the result
        return response()->json(['is_taken' => $isTaken]);
    }

    public function checkEmail(Request $request)
{
    $email = $request->input('email');

    // Check if email already exists in the database
    $isTaken = Lead::where('email', $email)->exists();

    return response()->json(['is_taken' => $isTaken]);
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

        $leads = Lead::find($id);

        // $request->validate([
        //     'customer_name' => 'required|string|max:255',
        //     'lead_date' => 'required',
        //     'branch' => 'required',
        //     'customer_address' => 'required|string|max:255',
        //     'contact_number' => 'required|string|max:10|min:10|unique:leads,contact_number',
        //     'service' => 'required|string',
        //     'referance' => 'required|string',
        // ]);
        $leads->update([
            'lead_date'=>$request->lead_date,
        'branch' => $request->branch,
        'customer_name' => $request->customer_name,
        'customer_address' => $request->customer_address,
        'contact_number' => $request->contact_number,
        'alternate_number' => $request->alternate_number,
        'alternate_number1' => $request->alternate_number1,
        'email' => $request->email,
        'enterd_by' => $request->enterd_by,
        'service' => $request->service,
        'landmark' => $request->landmark,
        'comments' => $request->comments,
        'referance'=>$request->referance
        ]);

        return redirect(route('lead.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy($id)
    {

        $lead = Lead::find($id);
        lead::destroy($lead->id);

        return redirect(route('lead.index'))->with('success', 'Deleted Successfully');
    }
}
