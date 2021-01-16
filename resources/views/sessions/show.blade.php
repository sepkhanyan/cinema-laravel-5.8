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
                            <img src="{{$session->movie['poster']}}" alt="{{$session->movie['title']}}" width="200">
                        </div>
                        <h4>
                            <b>Title:</b> {{ $session->movie['title'] }}
                        </h4>

                        <h4>
                            <b>Cinema:</b> {{ $session->cinema['title'] }}
                        </h4>

                        <h4>
                            <b>Hall:</b> {{ $session->hall['title'] }}
                        </h4>

                        <h4>
                            <b>Start Time:</b> {{$session['start_time']}}
                        </h4>

                        <h4>
                            <b>End Time:</b> {{$session['end_time']}}
                        </h4>
                        @if($session->movie['description'])
                            <h4>
                                <b>Description:</b> {{$session->movie['description']}}
                            </h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
