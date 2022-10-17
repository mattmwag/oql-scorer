@extends('fixtures.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>OQL Buzzer Quiz App</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('fixtures.create') }}"> Generate Next Round Fixtures</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <livewire:scorer :team1="$team1" :team2="$team2" :fid="$fid" />

@endsection

