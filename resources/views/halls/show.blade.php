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
                            <b>Title:</b> {{$hall['title']}}
                        </h4>
                        <h4>
                            <b>Rows:</b> {{$hall['rows']}}
                        </h4>
                        <h4>
                            <b>Chairs:</b> {{$hall['chairs']}}
                        </h4>
                        <h4>
                            <b>Cinema:</b> {{$hall->cinema['title']}}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
