@extends('layout')

@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
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

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Round</th>
            <th>Team One</th>
            <th>Team Two</th>
            <th width="280px">Action</th>
        </tr>
@foreach ($fixtures as $fixture)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $fixture->round }}</td>
                <td>{{ $fixture->teamOne->name }}</td>
                <td>{{ $fixture->teamTwo->name }}</td>
                <td>
                    <form action="{{ route('fixtures.destroy',$fixture->id) }}" method="POST">

                        @if ($fixture->teamTwo->name != 'Bye')
                        <a class="btn btn-info" href="{{ route('fixtures.edit',$fixture->id) }}">Run Game</a>
                        @endif

                        @if ($fixture->history)
                        <a class="btn btn-primary" href="{{ route('fixtures.show',$fixture->id) }}">View Scores</a>
                        @endif

@csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
@endforeach
    </table>

    {!! $fixtures->links() !!}

@endsection
