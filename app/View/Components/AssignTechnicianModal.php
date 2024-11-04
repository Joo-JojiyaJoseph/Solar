<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AssignTechnicianModal extends Component
{
    public $lead;
    public $technicians;
    public $selectedLeadId;

    /**
     * Create a new component instance.
     *
     * @param $lead
     * @param $technicians
     * @param $selectedLeadId
     */
    public function __construct($lead, $technicians, $selectedLeadId)
    {
        $this->lead = $lead;
        $this->technicians = $technicians;
        $this->selectedLeadId = $selectedLeadId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.assign-technician-modal');
    }
}
