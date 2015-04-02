<form action="{!! route('generate') !!}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <legend>Generate profiles</legend>
    <div class="form-group">
        <label for="">Number of generated profiles</label>
        <input type="number" class="form-control" name="count" placeholder="0">
    </div>

    <button type="submit" class="btn btn-primary">Generate</button>
</form>
