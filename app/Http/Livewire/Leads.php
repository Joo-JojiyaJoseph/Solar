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
    public $selectedStatus = null;



     public function loadleads(){
        $id = auth()->guard('admin')->user()->id;
        $this->user = Admin::find($id);

        if($this->selectedStatus!=null && $this->user->type=="branch" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
            ->join('sub_services', 'sub_services.id', '=', 'leads.sub_service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename','sub_services.title as subservicename')
             ->where('leads.status',$this->selectedStatus)->where('leads.branch',$this->user->id)->orderBy('id', 'desc')->get();
            }
        elseif($this->user->type=="branch" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
            ->join('sub_services', 'sub_services.id', '=', 'leads.sub_service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename','sub_services.title as subservicename')
             ->where('leads.branch',$this->user->id)->orderBy('id', 'desc')->get();
        }
        elseif($this->selectedStatus && $this->user->type=="technician" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
            ->join('sub_services', 'sub_services.id', '=', 'leads.sub_service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename','sub_services.title as subservicename')
             ->where('leads.status',$this->selectedStatus)->where('leads.technician',$this->user->id)->orderBy('id', 'desc')->get();
        }
        elseif($this->user->type=="technician" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
            ->join('sub_services', 'sub_services.id', '=', 'leads.sub_service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename','sub_services.title as subservicename')
             ->where('technician',$this->user->id)->orderBy('id', 'desc')->get();
        }
        elseif($this->selectedStatus) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
            ->join('sub_services', 'sub_services.id', '=', 'leads.sub_service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename','sub_services.title as subservicename')
             ->where('leads.status',$this->selectedStatus)->orderBy('id', 'desc')->get();
        }
        else{
        $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
        ->join('services', 'services.id', '=', 'leads.service')
        ->join('sub_services', 'sub_services.id', '=', 'leads.sub_service')
         ->select('leads.*', 'admins.name as branchname','services.name as servicename','sub_services.title as subservicename')
         ->orderBy('id', 'desc')->get();
        }
        $this->technicians = Admin::orderBy('id', 'desc')->where('type','technician')->get();
     }

     public function assignTechnician($leadId)
     {
        $this->selectedLeadId=$leadId;
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
         $this->dispatchBrowserEvent('refresh-page');
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
            'leads' => $this->leads,'user'=>$this->user,
        ]);

    }
}
