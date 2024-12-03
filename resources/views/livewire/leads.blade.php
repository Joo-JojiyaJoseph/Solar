<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
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
                        @if ($user->type == 'admin' || $user->type == 'branch')
                        <th scope="col">Service</th>
                        <th scope="col">Comments</th>
                        <th scope="col">Referance</th>
                        @endif
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $lead)
                    <tr @if($lead->status == 'pending') style="background: #9d1a1a;" @endif >
                        <th scope="row"> {{ ($leads->currentPage() - 1) * $leads->perPage() + $loop->iteration }}</th>
                        <td>{{ $lead->lead_date }}</td>
                        <td>{{ $lead->branchname }}</td>
                        <td>{{ $lead->customer_name }}<br>{{ $lead->customer_address }}<br>{{ $lead->landmark }}</br>{{ $lead->contact_number }}<br>{{ $lead->alternate_number }}</br>{{ $lead->alternate_number1 }}
                            </br>{{ $lead->email }}
                        </td>
                        @if ($user->type == 'admin' || $user->type == 'branch')
                        <td>{{ $lead->servicename }}<br>{{ $lead->subservicename }}</td>
                        <td>{{ $lead->comments }}</td>
                        <td>
                            <p class="text-nowrap">Referance : {{ $lead->referance }}</p></br>
                            <p class="text-nowrap"> Entered By : {{ $lead->enterd_by }}</p>
                        </td>
                        @endif
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

                        <td class="justify-between">
                            @if ($user->type == 'admin' || $user->type == 'branch')
                            <button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal"
                                data-target="#edit{{ $lead->id }}">Edit</button>

                            <a class="delete_btn btn btn-danger btn-block" data-action="{{ $lead->id }}"
                                message="Delete the $lead">
                                Delete
                            </a>
                            <form style="display: none" id="{{ $lead->id }}" method="post"
                                action="{{ route('lead.destroy', $lead) }}">
                                @csrf @method('delete')
                            </form>
                            @endif
                            @if ($user->type == 'admin' || $user->type == 'branch' )
                               <button type="button" class="btn btn-success btn-block mb-2 mt-2" data-toggle="modal"
                                        data-target="#assign{{ $lead->id }}"
                                        aria-label="Assign lead {{ $lead->customer_name }}">
                                        @if($lead->technician == NULL)
                                        Assign Technician
                                        @else
                                        Change Technician
                                        @endif
                                    </button>
                                    @endif

                             @if ($user->type == 'admin' && $lead->shedule_date == '')
                            <button type="button" class="btn btn-primary btn-block mb-2 mt-2 text-nowrap"
                                data-toggle="modal" data-target="#call{{ $lead->id }}"
                                aria-label="Assign lead {{ $lead->customer_name }}">
                                Call Shedule
                            </button>
                            @endif

                           @if ($user->type == 'technician' && $lead->status == 'pending')
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
                            @else
                            @endif
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Assign</button>
                                </div>
                            </form>
                        </div>
                    </div>
        </div>

        <!-- Modal for Assigning Technician -->
        <div class="modal fade" id="call{{ $lead->id }}" tabindex="-1" role="dialog" aria-labelledby="assignLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignLabel">Assign Call</h5>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Shedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
        </tbody>

        </table>
        <div class="mt-4">
            {{ $leads->links() }}
        </div>
        @foreach ($leads as $lead_edit)
        <div class="modal fade" id="edit{{ $lead_edit->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Leads</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <form action="{{ route('lead.update', $lead_edit) }}" method="post" class="space-y-4 p-10">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-white font-semibold">Lead Date</label>
                            <input type="date" value={{$lead_edit->lead_date}}
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300"
                                name="lead_date">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold">Branch</label>
                            <select name="branch"
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300 required">
                                <option value="">Select Branch*</option>
                                @foreach ($branchs as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ $branch->id == $lead_edit->branch ? 'selected' : '' }}>{{ $branch->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold">Customer Full Name*</label>
                            <input type="text" name="customer_name" value={{$lead_edit->customer_name}} required
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold">Customer Address*</label>
                            <textarea name="customer_address" required
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
                                    {{$lead_edit->customer_address}}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold">Landmark</label>
                            <input type="text" name="landmark"
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300"
                                value={{ $lead_edit->landmark }}>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold">Contact Number*</label>
                            <input type="tel" name="contact_number" value={{ $lead_edit->contact_number }} required
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold">Alternate Number1</label>
                            <input type="tel" name="alternate_number"
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300"
                                value={{ $lead_edit->alternate_number }}>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold">Alternate Number2</label>
                            <input type="tel" name="alternate_number1"
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300"
                                value={{ $lead_edit->alternate_number1 }}>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold">Email ID</label>
                            <input type="email" name="email"
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300"
                                value={{ $lead_edit->email }}>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold">Service</label>
                            <select name="service" id="service"
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ $service->id  == $lead_edit->service ? 'selected' : '' }}>{{ $service->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const serviceSelect = document.querySelector('select[name="service"]');
                            const subServiceSelect = document.querySelector('select[name="sub_service"]');

                            serviceSelect.addEventListener('change', function() {
                                const serviceId = this.value;

                                // Clear existing subservices
                                subServiceSelect.innerHTML =
                                    '<option value="">Select Sub Service</option>';

                                if (serviceId) {
                                    fetch(`/subservices/${serviceId}`)
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error(
                                                    `Network response was not ok: ${response.statusText}`
                                                    );
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            if (data.length === 0) {
                                                const noOption = document.createElement('option');
                                                noOption.textContent = 'No subservices available';
                                                subServiceSelect.appendChild(noOption);
                                            } else {
                                                data.forEach(subservice => {
                                                    const option = document.createElement(
                                                        'option');
                                                    option.value = subservice
                                                    .id; // Adjust if needed based on your model fields
                                                    option.textContent = subservice
                                                    .title; // Assuming 'name' is the field to display
                                                    subServiceSelect.appendChild(option);
                                                });
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Fetch operation error:', error);
                                        });
                                }
                            });
                        });
                        </script>


                        <div>
                            <label class="block text-gray-700 font-semibold">Comments</label>
                            <textarea name="comments"
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">{{ $lead_edit->comments }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold">Referance</label>
                            <input type="text" name="referance" value={{ $lead_edit->referance }}
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold">Entered By</label>
                            <input type="text" name="enterd_by"
                                class="w-full px-3 text-black py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300"
                                value={{ $lead_edit->enterd_by }}>
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="px-6 py-2 bg-green-500 text-white rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                                Update
                            </button>
                            <a href="{{ route('dashboard', '') }}"><button type="button"
                                    class="px-6 py-2 bg-blue-500 text-white rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                                    Cancel
                                </button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
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
@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#copy-print-csv').DataTable({
                processing: true,
                serverSide: true,
                paging: false,
                lengthChange: true,
                searching: true,
                info: true,
                order: [[0, 'desc']],
                ajax: {
                    url: "{{ route('lead.index') }}",
                    type: 'GET',
                    data: function(d) {
                        d.status = '{{ $selectedStatus }}';
                        d.branch = '{{ $user->id }}';
                    }
                }
            });
        });
    </script>
@endpush
