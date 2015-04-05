@extends('app');

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="page-header"></div>
            <div class='well'>
                <h1>Rating Statistics Page</h1>

            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Number of profiles with this count</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Rating</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $stats as $statRow)
                                <tr>
                                    <td>{{ $statRow['rating'] }}</td>
                                    <td>{{ $statRow['count'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()