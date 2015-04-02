@extends('app')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <div class="page-header"></div>
            <div class='well'>
                <h1>Home Page</h1>
                    @include('partials.generation_form')
                <hr/>
                    {{--@include('partials.rate_form')--}}
                {{--<hr/>--}}
                    @include('partials.search_form')
                <hr/>
                    @include('partials.stats_form')
                <hr/>

            </div>
        </div>
	</div>
@endsection
