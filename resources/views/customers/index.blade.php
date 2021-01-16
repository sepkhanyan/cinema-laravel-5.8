@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Search upcoming sessions</div>

                    <div class="card-body">
                        <div>
                            <form method="POST" action="{{url('/sessions/search')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row align-items-center">
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="title">Name</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                               placeholder="Movie Title" value="{{session('title') ?: ''}}">
                                    </div>
                                    <div class="col-auto my-1">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if (session('upcoming'))
                            @if(isset($sessions))
                                @if(count($sessions))
                                    <div class="mt-2">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Cinema</th>
                                                <th scope="col">Movie</th>
                                                <th scope="col">Hall</th>
                                                <th scope="col">Start Time</th>
                                                <th scope="col">End Time</th>
                                                <th scope="col" class="text-center"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sessions as $session)
                                                <tr>
                                                    <td>
                                                        {{ $session->cinema['title'] }}
                                                    </td>
                                                    <td>
                                                        {{ $session->movie['title'] }}
                                                    </td>
                                                    <td>
                                                        {{ $session->hall['title'] }}
                                                    </td>
                                                    <td>
                                                        {{ $session['start_time'] }}
                                                    </td>
                                                    <td>
                                                        {{ $session['end_time'] }}
                                                    </td>
                                                    <td class="text-center">

                                                        <a role="button" class="btn btn-success "
                                                           href="{{ url('/sessions/booking/' . $session['id']) }}">
                                                            Booking
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div>No upcoming sessions</div>
                                @endif
                            @endif
                        @endif
                        {{session()->forget(['upcoming', 'title'])}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
