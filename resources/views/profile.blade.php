@extends('app')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="page-header"></div>
        <div class='well'>
            <h1>{{ $profile->username }}'s Page</h1>
            
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Profile</div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Points given for country</th>
                                <th>Points given for id</th>
                                <th>Points given for reg date</th>
                                <th>Points taken for stats</th>
                                <th>Sumarised ratign</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $profile['email'] }}</td>
                                <td>{{ $profile['ratingRules'][0]['country_points'] }}</td>
                                <td>{{ $profile['ratingRules'][0]['id_points'] }}</td>
                                <td>{{ $profile['ratingRules'][0]['reg_date_points'] }}</td>
                                <td>{{ $profile['ratingRules'][0]['stat_decrease_points'] == 0? : -$profile->ratingRules[0]['stat_decrease_points'] }}</td>
                                <td>{{ $profile['rating'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()