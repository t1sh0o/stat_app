<form action="{!! route('rate') !!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <legend>Rate profiles</legend>
    <button type="submit" class="btn btn-primary">Rate all profiles</button>
</form>
