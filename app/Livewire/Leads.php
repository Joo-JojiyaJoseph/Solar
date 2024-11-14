<?php

namespace App\Livewire;

use App\Models\Admin\Admin;
use App\Models\Admin\Lead;
use App\Models\Admin\Service;
use Livewire\Component;

class Leads extends Component
{

    public $leads;
    public $type;
    public $status;
    public $user;
    public $services;
    public $branchs;
    public $technicians;
    public $technician_id;

    public $selectedLeadId;
    public $selectedStatus = null;



     public function loadleads(){
        $id = auth()->guard('admin')->user()->id;
        $this->user = Admin::find($id);

        $this->services = Service::Orderby('id', 'desc')->get();
        $this->branchs = Admin::Orderby('id', 'desc')->where('type','branch')->get();

        if($this->selectedStatus!=null && $this->user->type=="branch" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('leads.status',$this->selectedStatus)->where('leads.branch',$this->user->id)->orderBy('id', 'asc')->get();
            }
        elseif($this->user->type=="branch" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('leads.branch',$this->user->id)->orderBy('id', 'asc')->get();
        }
        elseif($this->selectedStatus && $this->user->type=="technician" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('leads.status',$this->selectedStatus)->where('leads.technician',$this->user->id)->orderBy('id', 'asc')->get();
        }
        elseif($this->user->type=="technician" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('technician',$this->user->id)->orderBy('id', 'asc')->get();
        }
        elseif($this->selectedStatus) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('leads.status',$this->selectedStatus)->orderBy('id', 'asc')->get();
        }
        else{
        $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
        ->join('services', 'services.id', '=', 'leads.service')
         ->select('leads.*', 'admins.name as branchname','services.name as servicename')
         ->orderBy('id', 'asc')->get();
        }
        $this->technicians = Admin::orderBy('id', 'asc')->where('type','technician')->get();
     }

     public function assignTechnician($leadId)
     {
        $this->selectedLeadId=$leadId;
         if ($this->selectedLeadId && $this->technician_id) {
             $lead = Lead::find($this->selectedLeadId);
             if ($lead) {
                 $lead->update(['technician' => $this->technician_id, 'status' => 'pending']);
                 session()->flash('message', 'Technician assigned successfully.');
                 $this->dispatch('technicianAssigned');
                 $this->reset(['technician_id', 'selectedLeadId']); // Reset values
                 $this->loadleads(); // Refresh leads data
             }
         }
         $this->dispatch('refresh-page');
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
