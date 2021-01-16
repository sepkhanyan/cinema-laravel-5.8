@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-2 mb-2">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card">
                    <div class="card-header">New Movie</div>

                    <div class="card-body">
                        <div>
                            <form method="POST" action="{{ url('/movies') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 @error('cinema_id') text-danger @enderror">
                                    <select class="custom-select" name="cinema_id" aria-label="Select cinema">
                                        @foreach($cinemas as $cinema)
                                            <option value="{{$cinema['id']}}">{{$cinema['title']}}</option>
                                        @endforeach
                                    </select>
                                    @error('cinema_id')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 @error('title') text-danger @enderror">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{old('title')}}">
                                    @error('title')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3  @error('poster') text-danger @enderror">
                                    <label for="poster" class="form-label">Poster</label>
                                    <input type="file" name="poster" class="form-control" id="poster">
                                    @error('poster')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="description"
                                              value="{{old('description')}}"></textarea>
                                </div>
                                <div class="mb-3 @error('duration') text-danger @enderror">
                                    <label for="duration" class="form-label">Duration (minutes)</label>
                                    <input type="number" name="duration" class="form-control" id="duration"
                                           value="{{old('duration')}}">
                                    @error('duration')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary mb-3">Save</button>
                                </div>
                            </form>
                        </div>
                        @if (session('not_created'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('not_created') }}
                            </div>
                            {{session()->forget('not_created')}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
