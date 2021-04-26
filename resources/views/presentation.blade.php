@extends('layouts.app')

@section('content')
<div class="container-fluid fill">
    <div class="row justify-content-center mb-2">
        <button class="btn btn-secondary collapse-controls" data-toggle="collapse" href="#controls-collapse" data-target="#controls-collapse" aria-expanded="false" aria-controls="controls-collpase">Controls</button>
    </div>
    <div class="row fill">
        {{-- @if ($host_id === auth()->id()) --}}
        @php $isHost = True
        @endphp
            <presentation-controls class="controls-collapse" id="controls-collapse"></presentation-controls>
        {{-- @else --}}
        @php $isHost = False
        @endphp
            <presentation-reactions class="controls-collapse" id="controls-collapse"></presentation-reactions>
        {{-- @endif --}}
            <presentation-video 
                :is-host="'{{$isHost}}'"
                :user-id="'{{Auth::user()->id}}'"
                :presentation="{{$presentation}}"
                turn-server-url="{{env('TURN_SERVER_URL')}}"
                turn-server-username="{{env('TURN_SERVER_USERNAME')}}"
                turn-server-credential="{{env('TURN_SERVER_CREDENTIAL')}}"></presentation-video>
            <presentation-chat></presentation-chat>
    </div>
</div>
@endsection
