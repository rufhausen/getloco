@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['method' => 'put', 'url' => '/location/'. $location['id']]) !!}
                <div class="form-group">
                    <label for="name">Parent Location?</label>
                    <select name="parent_id" class="form-control">
                        <option value="">Select one if you want...</option>
                        @foreach($locations as $loc)
                            <option {!!($location['parent_id']== $loc['id']? 'selected="selected"': null)!!} value="{{$loc['id']}}">{{$loc['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Location Name</label>
                    <input type="name" name="name" class="form-control" value="{{$location['name']}}">
                </div>
                <div class="form-group">
                    <label for="street_address">Street Address</label>
                    <input type="name" name="street_address" class="form-control" value="{{$location['street_address']}}">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="name" name="city" class="form-control" value="{{$location['city']}}">
                </div>
                <div class="form-group">
                    <label for="state_province">State/Province</label>
                    <input type="name" name="state_province" class="form-control" value="{{$location['state_province']}}">
                </div>
                <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input type="name" name="postal_code" class="form-control" value="{{$location['postal_code']}}">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
