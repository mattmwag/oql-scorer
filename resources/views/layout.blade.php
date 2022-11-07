<!DOCTYPE html>
<html>
<head>
    <title>OQL Buzzer Quiz App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>OQL Buzzer Quiz App</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('teams.index') }}"> Teams</a>
            <a class="btn btn-success" href="{{ route('fixtures.index') }}"> Fixtures</a>
            <a class="btn btn-success" href="{{ route('rankings') }}"> Rankings</a>
        </div>
    </div>
</div>

<br/><br/><br/>

<div class="container">
    @yield('content')
</div>

</body>
</html>
