@extends('layouts.app')

@section('content')
<div class="container-fluid fill">
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{!! \Session::get('success') !!}</p>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="alert alert-danger">
            <p>{!! \Session::get('error') !!}</p>
        </div>
    @endif
    <div class="row fill">
        <splash-controls></splash-controls>
        <splash-demo></splash-demo>
    </div>
</div>

@endsection
