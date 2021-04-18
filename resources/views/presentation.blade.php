@extends('layouts.app')

@section('content')
<div class="container-fluid fill">
    <div class="row fill">
        @if ($host_id === auth()->id())
            <presentation-controls>
            </presentation-controls>
        @else
       @endif
    </div>
</div>
@endsection
