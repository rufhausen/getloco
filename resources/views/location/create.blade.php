@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="/location">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name">Parent Location?</label>
                    <select name="parent_id" class="form-control">
                        <option value="">Select one if you want...</option>
                        @foreach($locations as $location)
                            <option value="{{$location['id']}}">{{$location['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Location Name</label>
                    <input type="name" name="name" class="form-control" placeholder="Provide a name">
                </div>
                <div class="form-group">
                    <label for="street_address">Street Address</label>
                    <input type="name" name="street_address" class="form-control" placeholder="Example: 123 Main St.">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="name" name="city" class="form-control" placeholder="Example: Denver">
                </div>
                <div class="form-group">
                    <label for="state_province">State/Province</label>
                    <input type="name" name="state_province" class="form-control" placeholder="Example: Colorado">
                </div>
                <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input type="name" name="postal_code" class="form-control" placeholder="Example: 80127">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection
