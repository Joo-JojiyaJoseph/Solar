<?php

namespace App\Livewire;
use App\Models\Admin\Admin;
use App\Models\Admin\Lead;
use Carbon\Carbon;
use App\Models\Admin\Service;

use Livewire\Component;


class CallLeads extends Component
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
    public $shedule_date;

    public function loadleads(){
        $today = Carbon::today();
        $id = auth()->guard('admin')->user()->id;
        $this->user = Admin::find($id);

        $this->services = Service::Orderby('id', 'desc')->get();
        $this->branchs = Admin::Orderby('id', 'desc')->where('type','branch')->get();

        if($this->selectedStatus!=null && $this->user->type=="branch" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('leads.status',$this->selectedStatus)->where('leads.branch',$this->user->id)
            ->whereDate('leads.schedule_date', $today)->orderBy('id', 'asc')->get();
            }
        elseif($this->user->type=="branch" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('leads.branch',$this->user->id)-> whereDate('leads.schedule_date', $today)->orderBy('id', 'asc')->get();
        }
        elseif($this->selectedStatus && $this->user->type=="technician" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('leads.status',$this->selectedStatus)->where('leads.technician',$this->user->id) ->whereDate('leads.schedule_date', $today)->orderBy('id', 'asc')->get();
        }
        elseif($this->user->type=="technician" ) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('technician',$this->user->id) ->whereDate('leads.schedule_date', $today)->orderBy('id', 'asc')->get();
        }
        elseif($this->selectedStatus) {
            $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
             ->select('leads.*', 'admins.name as branchname','services.name as servicename')
             ->where('leads.status',$this->selectedStatus) ->whereDate('leads.schedule_date', $today)->orderBy('id', 'asc')->get();
        }
        else{
        $this->leads = Lead::join('admins', 'admins.id', '=', 'leads.branch')
        ->join('services', 'services.id', '=', 'leads.service')
         ->select('leads.*', 'admins.name as branchname','services.name as servicename')
         ->whereDate('leads.schedule_date', $today)->orderBy('id', 'asc')->get();
        }
        $this->technicians = Admin::orderBy('id', 'asc')->where('type','technician')->get();
     }
    public function render()
    {
        $this->loadleads();
        return view('livewire.call-leads', [
            'leads' => $this->leads,'user'=>$this->user,
        ]);

    }
}
