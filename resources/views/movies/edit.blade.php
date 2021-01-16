@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-2 mb-2">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card">
                    <div class="card-header">Edit</div>

                    <div class="card-body">
                        <div>
                            <form method="POST" action="{{ url('/movies/' . $movie['id']) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3 @error('title') text-danger @enderror">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{old('title') ?: $movie['title']}}">
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
                                              value="{{old('description') ?: $movie['description']}}"></textarea>
                                </div>
                                <div class="mb-3 @error('duration') text-danger @enderror">
                                    <label for="duration" class="form-label">Duration (minutes)</label>
                                    <input type="number" name="duration" class="form-control" id="duration"
                                           value="{{old('duration') ?: $movie['duration']}}">
                                    @error('duration')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary mb-3">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
