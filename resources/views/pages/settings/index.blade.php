@extends('layouts.dashboard')

@section('styles')
    
@endsection

@section('title')
    Settings
@endsection


@section('content')


<div class="row">
    <div class="col-md-12 col-sm-12">
        @include('pages.settings.pwd_change_component')
    </div>
</div>


@endsection

@section('page_scripts')

@endsection

@section('scripts')
    
@endsection