@if ($errors->first())
    <div class="alert alert-danger">
        {!! $errors->first() !!}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        {!! Session::get('error') !!}
    </div>
@endif

@if (Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-secondary">
        {!! Session::get('warning') !!}
    </div>
@endif
