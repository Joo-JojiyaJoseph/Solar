<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">



    <div class="table-container">
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Lead Date</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Service</th>
                        <th scope="col">Comments</th>
                        <th scope="col">Referance</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $lead)
                        <tr @if ($lead->status == 'pending') style="background: #9d1a1a;" @endif>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $lead->lead_date }}</td>
                            <td>{{ $lead->branchname }}</td>
                            <td>{{ $lead->customer_name }}<br>{{ $lead->customer_address }}<br>{{ $lead->landmark }}</br>{{ $lead->contact_number }}<br>{{ $lead->alternate_number }}</br>{{ $lead->alternate_number1 }}
    </br>{{ $lead->email }}
                            </td>
                            <td>{{ $lead->servicename }}<br>{{ $lead->subservicename }}</td>
                            <td>{{ $lead->comments }}</td>
                            <td><p class="text-nowrap">Referance : {{ $lead->referance }}</p></br>
                             <p class="text-nowrap"> Entered By : {{ $lead->enterd_by }}</p> </td>
                            <td>{{ $lead->status }}</br>
                            @if($lead->shedule_date != '')
                                     <p class="text-nowrap">Call Sheduled on : {{ $lead->shedule_date }}</p>
                             @endif

                          
                            @if($lead->technician != NULL)
                            @foreach($technicians as $tech)
                            @if($tech->id==$lead->technician)
                            <p class="text-nowrap">Technician assigned : {{ $tech->name }}</p> 
                            @endif
                            @endforeach
                              
                            @endif
                        </td>
                     
                                <td>
                                    <button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal"
                                        data-target="#reshedule{{ $lead->id }}"
                                        aria-label="Assignlead {{ $lead->customer_name }}">
                                        ReShedule
                                    </button> 

                                    <button type="button" class="btn btn-success btn-block mb-2" data-toggle="modal"
                                        data-target="#assign{{ $lead->id }}"
                                        aria-label="Assign lead {{ $lead->customer_name }}">
                                        @if($lead->technician == NULL)
                                        Assign Technician
                                        @else
                                        Change Technician
                                        @endif
                                    </button>

                                    <button type="button" class="btn btn-danger btn-block mb-2" data-toggle="modal"
                                        data-target="#reshedule{{ $lead->id }}"
                                        aria-label="Assignlead {{ $lead->customer_name }}">
                                        Reject
                                    </button>

                                </td>
                        </tr>
                        <!-- Modal for Assigning Technician -->
                         <div class="modal fade" id="assign{{ $lead->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="assignLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="assignLabel">Assign Lead</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form wire:submit="assignTechnician({{ $lead->id }})">
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-md-6 mb-3">

                                                    <label for="technician">Technician</label>
                                                    <select id="technician" wire:model="technician_id"
                                                        class="form-control required">
                                                        <option value="">Select technician*</option>
                                                        @foreach ($technicians as $technician)
                                                            <option value="{{ $technician->id }}">
                                                                {{ $technician->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('technician_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Assign</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 

                        <!-- Modal for Assigning Technician -->
                        <div class="modal fade" id="reshedule{{ $lead->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="Assignlead" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="Assignlead">Assign Call</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form wire:submit="shedule({{ $lead->id }})">
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="shedule_date">date</label>
                                                    <input type="date" wire:model="shedule_date"
                                                        class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300"
                                                        name="lead_date">
                                                    </select>
                                                    @error('shedule_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Shedule</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('refresh-page', event => {
                location.reload(); // Reloads the current page
            });
        });
    </script>
</div>
