<?php

namespace App\Http\Livewire;

use App\Models\Admin\Lead;
use Livewire\Component;

class Leads extends Component
{
    public $leads;
    public $type;
    public $status;



     public function loadleads(){
        
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
