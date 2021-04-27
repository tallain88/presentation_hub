@extends('layouts.app')

@section('content')
<div class="container-fluid fill">
    <div class="row justify-content-center mb-2">
        <button class="btn btn-secondary collapse-controls" data-toggle="collapse" href="#controls-collapse" data-target="#controls-collapse" aria-expanded="false" aria-controls="controls-collpase">Controls</button>
    </div>
    <div class="row fill">
        @if ($host_id === Auth::id())
            <presentation-controls class="controls-collapse" id="controls-collapse" presentationid={{ $presentation_id ?? Session::get('presentation_id') }}></presentation-controls>
        @else
            <presentation-reactions class="controls-collapse" id="controls-collapse" username="{{Auth::check() ? Auth::user()->name : ''}}" userid="{{Auth::id() ?? null}}" presentationid={{ $presentation_id ?? Session::get('presentation_id') }}></presentation-reactions>
        @endif
            <presentation-video 
                presentationid={{'presentationId'}}
                :is-host="'{{ $host_id ?? Session::get('host_id') !== null }}'"
                :user-id="'{{Auth::id()}}'"
                :presentation="{{$presentation}}"
                turn-server-url="{{env('TURN_SERVER_URL')}}"
                turn-server-username="{{env('TURN_SERVER_USERNAME')}}"
                turn-server-credential="{{env('TURN_SERVER_CREDENTIAL')}}"></presentation-video>
            <presentation-chat username="{{Auth::check() ? Auth::user()->name : ''}}" userid="{{Auth::id() ?? null}}" presentationid={{ $presentation_id ?? Session::get('presentation_id') }}></presentation-chat>
    </div>
</div>
@endsection
