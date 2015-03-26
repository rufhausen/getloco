@extends('layouts.master')

@section('content')
    <script>

    </script>
    <div class="row">
        <div class="col-md-12">
            @if ($locations)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Full Address</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <th scope="row">
                                <a href="#delete-location-modal-{{$location['id']}}" role="button" class="btn btn-danger btn-xs" data-toggle="modal">Delete</a>
                            </th>
                            <td><a href="/location/{{$location['id']}}/edit">{{$location['name']}}</a></td>
                            <td>{{$location['formatted_address']}}</td>
                            <td>{{$location['latitude']}}</td>
                            <td>{{$location['longitude']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3>No locations yet. Add one.</h3>
            @endif
        </div>
    </div>
    @foreach($locations as $location)
        <div id="delete-location-modal-{{$location['id']}}" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Delete Location</h4>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this location"?</p>
                    </div>
                    <div class="modal-footer">
                        {!!Form::open(array('method' => 'DELETE','url' => '/location/'.$location['id']))!!}
                        {!!Form::submit('Yes',array('class' => 'btn btn-danger'))!!}
                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancel
                        </button>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
        @endif

@endsection
