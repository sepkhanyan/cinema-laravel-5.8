@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-2 mb-2">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card">
                    <div class="card-header">New Session for {{$cinema['title']}}</div>

                    <div class="card-body">
                        <div>
                            <form method="POST" action="{{ url('/sessions') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="cinema_id" value="{{$cinema['id']}}">
                                <div class="mb-3 @error('movie_id') text-danger @enderror">
                                    <select class="custom-select" name="movie_id" aria-label="Select movie">
                                        @foreach($movies as $movie)
                                            <option value="{{$movie['id']}}">{{$movie['title']}}, {{$movie['duration']}} min</option>
                                        @endforeach
                                    </select>
                                    @error('movie_id')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 @error('hall_id') text-danger @enderror">
                                    <select class="custom-select" name="hall_id" aria-label="Select hall">
                                        @foreach($halls as $hall)
                                            <option value="{{$hall['id']}}">{{$hall['title']}}</option>
                                        @endforeach
                                    </select>
                                    @error('hall_id')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 @error('start_time') text-danger @enderror">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="datetime-local" name="start_time" class="form-control" id="start_time"
                                           value="{{old('start_time')}}">
                                    @error('start_time')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary mb-3">Save</button>
                                </div>
                            </form>
                        </div>
                        @if (session('active_session'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('active_session') }}
                            </div>
                            {{session()->forget('active_session')}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $('.cinema-select').change(function ()
        {
            var id = $(this).val();
            var url = '/get-halls-and-movies/' + id;

            $.ajax({
                url: url,
                method: 'GET',
                contentType: false,
                processData: false,
                success: function (result) {
                    $('#moviesAndHalls').html(result.html)
                }
            });
        });
    </script>
@endsection
