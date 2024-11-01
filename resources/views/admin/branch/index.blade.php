@extends('admin.layouts.app')

@section('title', 'branch branch')

@section('content')
    <div class="main-container">

        <div class="row gutters mb-3">
            <div class="col-md-12 mb-2">
                @include('admin.layouts.alert')
            </div>

            <div class="col-xs-2 mb-2">
                <a href="{{ route('dashboard', '') }}" class="btn btn-primary">Back</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                    ADD branch
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
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branchs as $branch)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $branch->name }}</td>
                                        <td>{{ $branch->username }}</td>
                                        <td>{{ $branch->phone }}</td>
                                        <td>
                                            <img src="{{ asset('/storage/' . $branch->image) }}"
                                                style="width: 100px; height: 50px">
                                        </td>
                                        <td >
                                            <button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal"
                                                data-target="#edit{{ $branch->id }}">Edit</button>

                                                <a href=""><button type="button" class="btn btn-primary btn-block">login</button></a>

                                            {{-- <a class="delete_btn btn btn-danger btn-block"
                                                data-action="{{ $branch->id }}" message="Delete the branch">
                                                Delete
                                            </a>

                                            <form style="display: none" id="{{ $branch->id }}" method="post"
                                                action="{{ route('branch.destroy', $branch) }}">
                                                @csrf @method('delete')
                                            </form> --}}
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
                    <h5 class="modal-title">New branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('branch.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">

                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email <Title></Title></label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required>
                                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Password <Title></Title></label>
                                <input type="text" class="form-control" name="password"
                                    value="{{ old('password') }}" required>
                                @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>phone <Title></Title></label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ old('phone') }}" required>
                                @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
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
   @foreach ($branchs as $branch_edit)
        <div class="modal fade" id="edit{{ $branch_edit->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit branch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('branch.update', $branch_edit) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group row">


                                <div class="col-md-6 mb-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $branch_edit->name }}">
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>email<Title></Title></label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $branch_edit->username }}">
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>email<Title></Title></label>
                                    <input type="password" class="form-control" name="password"
                                        value="{{ $branch_edit->password }}">
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label>phone<Title></Title></label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ $branch_edit->phone }}">
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Image (80px * 80px)</label>
                                    <input type="file" class="form-control" name="image">
                                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                    <img src="{{ asset('/storage/' . $branch_edit->image) }}"
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
