<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use App\Models\Admin\SubService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::Orderby('id', 'desc')->get();
        $subservices = SubService::join('services', 'sub_services.service_id', '=', 'services.id')
                ->select('sub_services.*', 'services.name as name','services.id as services_ids') // Assuming services have a 'name' column
                ->orderBy('sub_services.id', 'desc')
                ->get();

        return view('admin.subservices.index',compact('subservices','services'));
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

    public function getSubServices($serviceId)
    {
        Log::info("Fetching subservices for service ID: " . $serviceId);
        
        $subservices = SubService::where('service_id', $serviceId)->get();
        return response()->json($subservices);
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
            'service_id'=>'required',
            'title' => 'required',
        ]);

       SubService::create([
            'service_id' => $request->service_id,
            'title' => $request->title,
        ]);

        return redirect(route('subservices.index'))->with('success', 'Added Successfully');
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
        $subservices = SubService::find($id);

        $request->validate([
            'service_id'=>'required',
            'title' => 'required',
        ]);
        $subservices->update([
            'service_id' => $request->service_id,
            'title' => $request->title,
        ]);

        return redirect(route('subservices.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $subservice = SubService::find($id);
        SubService::destroy($subservice->id);

        return redirect(route('subservices.index'))->with('success', 'Deleted Successfully');
    }
}
