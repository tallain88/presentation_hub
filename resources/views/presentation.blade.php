@extends('layouts.app')

@section('content')
<div class="container-fluid fill">
    <div class="row justify-content-center mb-2">
        <button class="btn btn-secondary collapse-controls" data-toggle="collapse" href="#controls-collapse" data-target="#controls-collapse" aria-expanded="false" aria-controls="controls-collpase">Controls</button>
    </div>
    <div class="row fill">
        @if ($host_id === auth()->id())
            <presentation-controls class="controls-collapse" id="controls-collapse"></presentation-controls>
        @else
            {{-- <presentation-reactions></presentation-reactions> --}}
        @endif
            <presentation-video></presentation-video>
            <presentation-chat></presentation-chat>
    </div>
</div>
@endsection
