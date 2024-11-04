{{-- resources/views/components/assign-technician-modal.blade.php --}}
<div x-data="{ openModal: false }">
    <!-- Button to open the modal -->
    <button @click="openModal = true" class="btn btn-primary btn-block mb-2">Assign</button>

    <!-- Modal -->
    <div x-show="openModal" x-transition.opacity
         class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-75">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Technician</h5>
                    <button type="button" @click="openModal = false" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="assignTechnician">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label>Technician</label>
                                <select wire:model="technician_id" class="form-control required">
                                    <option value="">Select technician*</option>
                                    @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                    @endforeach
                                </select>
                                @error('technician_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" @click="openModal = false" class="btn btn-secondary">Close</button>
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
