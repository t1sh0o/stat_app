@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="page-header"></div>
                <div class='well'>
                <h1>Home Page</h1>
                
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Generate profiles</div>

                <div class="panel-body">
                    @include('partials.generation_form')
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Get rating for profile</div>

                <div class="panel-body">
                    @include('partials.search_form')
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Get rating for profile</div>

                <div class="panel-body">
                    @include('partials.stats_form')
                </div>
            </div>
        </div>
	</div>
@endsection
