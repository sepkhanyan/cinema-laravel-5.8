@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> {{$session->cinema['title']}}, {{$session->hall['title']}}
                        , {{$session->movie['title']}}, {{$session->movie['duration']}} min
                    </div>
                    @if (session('booked'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('booked') }}
                        </div>
                        {{session()->forget('booked')}}
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{url('/sessions/booking/' . $session['id']) }}">
                            @csrf
                            <table class="table">
                                <thead>

                                </thead>
                                <tbody>
                                @foreach($rows as $row)
                                    <tr>
                                        @foreach($chairs as $chair)
                                            @if($bookings->contains('sit', "$row,$chair"))
                                                <td class="scope border"
                                                    style="cursor: default; background: {{$bookings->contains('user_id',  auth()->user()->id) ? 'green' : 'red' }}">
                                                    {{$chair}}
                                                </td>
                                            @else
                                                <td class="scope border row-chair-box"
                                                    style="cursor: pointer; background: white">
                                                    {{$chair}}
                                                    <input class="row-chair" type="checkbox" name="sit[]"
                                                           value="{{$row}},{{$chair}}" style="visibility: hidden">
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mb-3">To Book</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $('.row-chair-box').click(function () {
            if ($(this).children('.row-chair').prop('checked') === true) {
                $(this).children('.row-chair').prop('checked', false);
                $(this).css('background', 'white');
            } else {
                $(this).children('.row-chair').prop('checked', true);
                $(this).css('background', 'green');
            }
        });

    </script>
@endsection
