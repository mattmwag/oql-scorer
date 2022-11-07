@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>OQL Buzzer Quiz App</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <br/><br/>

    <h1>{{ $fixture->teamOne()->first()->name }} vs. {{ $fixture->teamTwo()->first()->name }}</h1>

    <br/>

    @foreach (unserialize($fixture->history) as $event)
        @if ($event[1] == 20)
            @switch($event[0])
                @case("t1p1")
                <div>{{ $t1p1 }} ({{$fixture->teamOne()->first()->name}}) buzzed in for 20</div>
                @break
                @case("t2p1")
                <div>{{ $t2p1 }} ({{$fixture->teamTwo()->first()->name}}) buzzed in for 20</div>
                @break
            @endswitch
        @endif
        @if ($event[0] == "t1bonuses")
            <div>{{ $fixture->teamOne()->first()->name . " answered a tossup for " . $event[1] }}</div>
        @endif
        @if ($event[0] == "t2bonuses")
            <div>{{ $fixture->teamTwo()->first()->name . " answered a tossup for " . $event[1] }}</div>
        @endif
    @endforeach

    <br/>

    <h1>Final score: {{ $t1_total }} - {{ $t2_total }}</h1>

@endsection

