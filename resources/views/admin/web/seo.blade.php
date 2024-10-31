@extends('admin.layouts.app')

@section('title', 'SEO Management')

@section('content')

    <div class="main-container">

        <div class="row gutters mb-3">
            <div class="col-md-12 mb-2">
                @include('admin.layouts.alert')
            </div>

            <div class="col-xs-12 mb-2">
                <a href="{{ route('dashboard', 'web') }}" class="btn btn-primary">Back</a>
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
                                    <th>Page</th>
                                    <th>Seo Title</th>
                                    <th>Seo Description</th>
                                    <th>Seo Keywords</th>
                                    <th>Og Title</th>
                                    <th>Og Image</th>
                                    <th>Og Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($seo as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->page }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->keywords }}</td>
                                        <td>{{ $item->og_title }}</td>
                                        <td>
                                            @if($item->image)
                                                <img src="{{ asset('/storage/' . $item->image) }}" style="width: 100px; height: 50px">
                                            @endif
                                        </td>
                                        <td>{{ $item->og_description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit{{ $item->id }}">Edit</button>
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

    @foreach ($seo as $item)
        <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit {{ $item->page }} Seo Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('seo.update', $item->id) }}" method="post" enctype="multipart/form-data">
                        @csrf @method('put')
                        <div class="modal-body">
                            <div class="form-group row">

                                <div class="col-md-12 mb-3">
                                    <label>Seo Title*</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title', $item->title) }}" required>
                                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Seo Description*</label>
                                    <textarea class="form-control" name="description" required>{{ old('description', $item->description) }}</textarea>
                                    @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Seo Keywords*</label>
                                    <textarea class="form-control" name="keywords" required>{{ old('keywords', $item->keywords) }}</textarea>
                                    @error('keywords')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Og Title</label>
                                    <input type="text" class="form-control" name="og_title" value="{{ old('og_title', $item->og_title) }}">
                                    @error('og_title')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-9 mb-3">
                                    <label>Og Image (Min 200px * 200px)</label>
                                    <input type="file" class="form-control" name="image">
                                    <span>Allowed Maximum File size up to 300kb. File type jpg | png | jpeg | gif | bmp.</span>
                                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    @if($item->image)
                                        <img src="{{ asset('/storage/' . $item->image) }}" style="width: 100px; height: 100px">
                                    @endif
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Og Description</label>
                                    <textarea class="form-control" name="og_description">{{ old('og_description', $item->og_description) }}</textarea>
                                    @error('og_description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
