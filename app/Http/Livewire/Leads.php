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



     public function loadleads(){
        $id = auth()->guard('admin')->user()->id;
        $this->user = Admin::find($id);
        $this->leads = Lead::orderBy('id', 'desc')->get();
     }

    public function render()
    {
        $this->loadleads();
        return view('livewire.leads', [
            'leads' => $this->leads,
        ]);
    }
}
