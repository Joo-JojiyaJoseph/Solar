<?php

namespace App\Http\Livewire;

use App\Models\Admin\Admin;
use App\Models\Admin\Lead;
use Livewire\Component;

class Leads extends Component
{

    public $leads;
    public $type;
    public $status;
    public $user;
    public $technicians;
    public $technician_id;

    public $selectedLeadId;



     public function loadleads(){
        $id = auth()->guard('admin')->user()->id;
        $this->user = Admin::find($id);
        $this->leads = Lead::orderBy('id', 'desc')->get();
        $this->technicians = Admin::orderBy('id', 'desc')->where('type','technician')->get();
     }
     public function assignTechnician()
     {
         if ($this->selectedLeadId && $this->technician_id) {
             $lead = Lead::find($this->selectedLeadId);
             if ($lead) {
                 $lead->update(['technician' => $this->technician_id, 'status' => 'pending']);
                 session()->flash('message', 'Technician assigned successfully.');
                 $this->emit('technicianAssigned');
                 $this->reset(['technician_id', 'selectedLeadId']); // Reset values
                 $this->loadleads(); // Refresh leads data
             }
         }
         else{
            dd($this->selectedLeadId,$this->technician_id);
         }
     }

     public function markAsWorking($leadId)
{
    $lead = Lead::find($leadId);
    if ($lead) {
        $lead->status = 'working';
        $lead->save();
    }
}

public function markAsCompleted($leadId)
{
    $lead = Lead::find($leadId);
    if ($lead) {
        $lead->status = 'completed';
        $lead->save();
    }
}

public function markAsPending($leadId)
{
    $lead = Lead::find($leadId);
    if ($lead) {
        $lead->status = 'pending';
        $lead->save();
    }
}

    public function render()
    {
        $this->loadleads();
        return view('livewire.leads', [
            'leads' => $this->leads,
        ]);

    }
}
