@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-2 mb-2">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card">
                    <div class="card-header">Info</div>

                    <div class="card-body">
                        <h4>
                            <b>Title:</b> {{$cinema['title']}}
                        </h4>
                        <h4>
                            <b>Address:</b> {{$cinema['address']}}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
