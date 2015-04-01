@extends('app')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <h1>Home Page</h1>
            <div class='well'>
                <form action="{!! route('generate') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <label for="">Number of generated profiles</label>
                        <input type="number" class="form-control" name="count" placeholder="0">
                    </div>
                
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>  
		</div>
	</div>
@endsection
