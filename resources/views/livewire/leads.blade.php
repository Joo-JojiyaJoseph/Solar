
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="d-flex justify-content-end"> <!-- Use Flexbox to align items to the right -->
        <div class="mb-3 w-25"> <!-- Remove text-write class as it was a typo -->
            <label for="statusFilter">Filter by Status:</label>
            <select wire:model.live="selectedStatus" class="form-control"> <!-- Set width -->
                <option value="">All</option>
                <option value="new">New</option>
                <option value="pending">Pending</option>
                <option value="working">Working</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>


    <div class="table-container">
        <div class="table-responsive">
            <table id="copy-print-csv" class="table custom-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Lead Date</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Service</th>
                        <th scope="col">Comments</th>
                        <th scope="col">Referance</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $lead)
                        <tr @if($lead->status == 'pending') style="background: #9d1a1a;" @endif>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $lead->lead_date }}</td>
                            <td>{{ $lead->branchname }}</td>
                            <td>{{ $lead->customer_name }}<br>{{ $lead->customer_address }}<br>{{ $lead->landmark }}
                            </td>
                            <td>{{ $lead->contact_number }}<br>{{ $lead->alternate_number }}</br>{{ $lead->alternate_number1 }}</td>
                            <td>{{ $lead->email }}</td>
                            <td>{{ $lead->servicename }}<br>{{ $lead->subservicename }}</td>
                            <td>{{ $lead->comments }}</td>
                            <td>{{ $lead->referance }}</td>
                            <td>{{ $lead->status }}</td>
                              @if ($user->type != 'marketting')
                            <td>
                                @if ($user->type != 'technician' && $lead->status == 'new')
                                    <button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal"
                                        data-target="#assign{{ $lead->id }}"
                                        aria-label="Assign lead {{ $lead->customer_name }}">
                                        Assign
                                    </button>
                                @elseif ($user->type != 'technician' && $lead->status != 'new')
                                    <p>Assigned</p>
                                @elseif ($user->type == 'technician' && $lead->status == 'pending')
                                    <button type="button" class="btn btn-success btn-block"
                                        wire:click="markAsWorking({{ $lead->id }})"
                                        aria-label="Mark lead {{ $lead->customer_name }} as working">Working</button>
                                @elseif ($user->type == 'technician' && $lead->status == 'working')
                                    <button type="button" class="btn btn-danger btn-block"
                                        wire:click="markAsPending({{ $lead->id }})"
                                        aria-label="Mark lead {{ $lead->customer_name }} as pending">Pending</button>
                                    <button type="button" class="btn btn-success btn-block"
                                        wire:click="markAsCompleted({{ $lead->id }})"
                                        aria-label="Mark lead {{ $lead->customer_name }} as completed">Completed</button>
                                @elseif ($user->type == 'technician' && $lead->status == 'completed')
                                    <p>Completed</p>
                                @endif
                            </td>
                            @endif
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
                                                    {{-- <input type="text" wire:model="selectedLeadId" value="4"> --}}
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
