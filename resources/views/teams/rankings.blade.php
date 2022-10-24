@extends('teams.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>OQL Buzzer Quiz App</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('teams.create') }}"> Create New Team</a>
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
            <th>Name</th>
            <th>LeaguePoints</th>
            <th>PointsPerStarter</th>
            <th>PointsConcededPerStarter</th>
            <th>CorrectBuzzes</th>
            <th>Negs</th>
        </tr>
        @foreach ($teams as $team)
            <tr>
                <td>{{ $team->name }}</td>
                <td>{{ $team->leaguePoints }}</td>
                <td>{{ $team->pointsPerStarter }}</td>
                <td>{{ $team->pointsConcededPerStarter }}</td>
                <td>{{ $team->correctBuzzes }}</td>
                <td>{{ $team->negs }}</td>

                {{--                <td>--}}
{{--                    <form action="{{ route('teams.destroy',$team->id) }}" method="POST">--}}

{{--                        <a class="btn btn-info" href="{{ route('teams.show',$team->id) }}">Show</a>--}}

{{--                        <a class="btn btn-primary" href="{{ route('teams.edit',$team->id) }}">Edit</a>--}}

{{--                        @csrf--}}
{{--                        @method('DELETE')--}}

{{--                        <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
            </tr>
        @endforeach
    </table>
@endsection
