@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
           <h3>{{$location['location']['name']}}</h3>
            <div>{{$location['location']['street_address']}}</div>
        </div>
    </div>
@endsection
