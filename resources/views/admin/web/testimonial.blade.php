@extends('admin.layouts.app')

@section('title', 'Testimonial testimonial')

@section('content')

    <div class="main-container">

        <div class="row gutters mb-3">
            <div class="col-md-12 mb-2">
                @include('admin.layouts.alert')
            </div>

            <div class="col-xs-2 mb-2">
                <a href="{{ route('dashboard', 'web') }}" class="btn btn-primary">Back</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                    ADD Testimonial
                </button>
            </div>
        </div>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-container">
                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Quote</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $testimonial->name }}</td>
                                        <td>{{ $testimonial->designation }}</td>
                                        <td>{{ $testimonial->quote }}</td>
                                        <td>
                                            <img src="{{ asset('/storage/' . $testimonial->image) }}"
                                                style="width: 100px; height: 50px">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                                data-target="#edit{{ $testimonial->id }}">Edit</button>

                                            <a class="delete_btn btn btn-danger btn-block"
                                                data-action="{{ $testimonial->id }}" message="Delete the Testimonial">
                                                Delete
                                            </a>

                                            <form style="display: none" id="{{ $testimonial->id }}" method="post"
                                                action="{{ route('testimonial.destroy', $testimonial) }}">
                                                @csrf @method('delete')
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Testimonial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('testimonial.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">

                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Designation <Title></Title></label>
                                <input type="text" class="form-control" name="designation"
                                    value="{{ old('designation') }}" required>
                                @error('designation')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>


                            <div class="col-md-12 mb-3">
                                <label>Quote<Title></Title></label>
                                <textarea name="quote" class="form-control" required='true'>{{ old('quote') }}</textarea>
                                @error('quote')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Image (80px * 80px)</label>
                                <input type="file" class="form-control" name="image" required>
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($testimonials as $testimonial_edit)
        <div class="modal fade" id="edit{{ $testimonial_edit->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('testimonial.update', $testimonial_edit) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group row">


                                <div class="col-md-6 mb-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $testimonial_edit->name }}">
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Designation <Title></Title></label>
                                    <input type="text" class="form-control" name="designation"
                                        value="{{ $testimonial_edit->designation }}">
                                    @error('designation')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Quote<Title></Title></label>
                                    <textarea name="quote" class="form-control">{{ $testimonial_edit->quote }}</textarea>
                                    @error('quote')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Image (80px * 80px)</label>
                                    <input type="file" class="form-control" name="image">
                                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                    <img src="{{ asset('/storage/' . $testimonial_edit->image) }}"
                                        style="width: 100px; height: 50px; margin-top: 20px;">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="case" value="insert">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
