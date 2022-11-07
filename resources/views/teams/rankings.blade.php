@extends('layout')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Group</th>
            <th>LeaguePoints</th>
            <th>Total Points For</th>
            <th>Total Points Against</th>
            <th>PointsPerStarter</th>
            <th>PointsConcededPerStarter</th>
            <th>CorrectBuzzes</th>
            <th>Negs</th>
        </tr>
        @foreach ($teams as $team)
            <tr style="{{ $team->group % 2 == 1 ? 'background-color: aliceblue' : '' }}">
                <td>{{ $team->name }}</td>
                <td>{{ $team->group }}</td>
                <td>{{ $team->leaguePoints }}</td>
                <td>{{ $team->totalPointsFor }}</td>
                <td>{{ $team->totalPointsAgainst }}</td>
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
