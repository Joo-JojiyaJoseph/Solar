<?php

namespace App\Livewire;

use App\Models\Admin\Admin;
use App\Models\Admin\Lead;
use App\Models\Admin\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Leads extends Component
{
    use WithPagination;

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
    public $search = ''; // New property for search input

    public function updatingSearch()
    {
        // Reset the pagination whenever the search input changes
        $this->resetPage();
    }

    public function loadleads()
    {
        $id = auth()->guard('admin')->user()->id;
        $this->user = Admin::find($id);

        $this->services = Service::orderBy('id', 'desc')->get();
        $this->branchs = Admin::orderBy('id', 'desc')->where('type', 'branch')->get();

        $query = Lead::join('admins', 'admins.id', '=', 'leads.branch')
            ->join('services', 'services.id', '=', 'leads.service')
            ->select('leads.*', 'admins.name as branchname', 'services.name as servicename');

            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('leads.customer_name', 'like', '%' . $this->search . '%')
                      ->orWhere('leads.contact_number', 'like', '%' . $this->search . '%')
                      ->orWhere('leads.email', 'like', '%' . $this->search . '%')
                      ->orWhere('leads.comments', 'like', '%' . $this->search . '%');
                });
            }

        if ($this->selectedStatus) {
            $query->where('leads.status', $this->selectedStatus);
        }

        if ($this->user->type === "branch") {
            $query->where('leads.branch', $this->user->id);
        } elseif ($this->user->type === "technician") {
            $query->where('leads.technician', $this->user->id);
        }


        $this->technicians = Admin::orderBy('id', 'asc')->where('type', 'technician')->get();

        return $query->orderBy('leads.id', 'asc');
    }

    public function assignTechnician($leadId)
    {
        $this->selectedLeadId = $leadId;

        if ($this->selectedLeadId && $this->technician_id) {
            $lead = Lead::find($this->selectedLeadId);
            if ($lead) {
                $lead->update(['technician' => $this->technician_id, 'status' => 'pending']);
                session()->flash('message', 'Technician assigned successfully.');
                $this->dispatch('technicianAssigned');
                $this->reset(['technician_id', 'selectedLeadId']);
            }
        }

        $this->dispatch('refresh-page');
    }

    public function shedule($leadId)
    {
        $this->selectedLeadId = $leadId;
        $lead = Lead::find($this->selectedLeadId);

        if ($lead) {
            $lead->update(['shedule_date' => $this->shedule_date, 'status' => 'pending']);
            session()->flash('message', 'Call assigned successfully.');
            $this->dispatch('call');
            $this->reset(['shedule_date']);
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
        $leads = $this->loadleads()->paginate(10);

        return view('livewire.leads', [
            'leads' => $leads,
            'user' => $this->user,
        ]);
    }
}
