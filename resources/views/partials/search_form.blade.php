
<form action="{{ action('ProfilesController@getRating') }}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <legend>Get rating for profile</legend>

    <div class="form-group">
        <label for="">Email:</label>
        <input type="email" class="form-control" name="email" placeholder="john(at)exmaple.com">
    </div>

    <button type="submit" class="btn btn-primary">Get Rating</button>
</form>
