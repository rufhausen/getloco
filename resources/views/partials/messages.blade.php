@if (session('success'))
    <div class="alert alert-success"><i class="fa fa-thumbs-up"></i> {{session('success')}}</div>
@endif

@if (session('warning'))
    <div class="alert alert-warning"><i class="fa fa-warning"></i> {{session('warning')}}</div>
@endif
@if (session('info'))
    <div class="alert alert-info"> <i class="fa fa-info"></i>{{session('info')}}</div>
@endif

{{-- Validation Errors --}}
@foreach ($errors->all(':message') as $error)
    <div class="alert alert-danger" style="margin-bottom: 2px;margin-top: 2px;"><i class="fa fa-warning"></i>
        <strong>Error:</strong> {{$error}}</div>
@endforeach
