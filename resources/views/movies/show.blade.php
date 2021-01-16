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

                        <div class="mb-5">
                            <img src="{{$movie['poster']}}" alt="{{$movie['title']}}" width="200">
                        </div>
                        <h4>
                            <b>Title:</b> {{$movie['title']}}
                        </h4>
                        @if($movie['description'])
                            <h4>
                                <b>Description:</b> {{$movie['description']}}
                            </h4>
                        @endif

                        <h4>
                            <b>Duration:</b> {{$movie['duration']}} min
                        </h4>

                        <h4>
                            <b>Cinema:</b> {{$movie->cinema['title']}}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
