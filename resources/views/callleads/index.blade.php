@extends('admin.layouts.app')

@section('title', 'CallLeads')

@section('content')
    <div class="main-container">

        <div class="row gutters mb-3">
            <div class="col-md-12 mb-2">
                @include('admin.layouts.alert')
            </div>

            <div class="col-xs-2 mb-2">
                <a href="{{ route('dashboard', '') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="row gutters">
            @livewire('CallLeads')
        </div>
    </div>

@endsection
