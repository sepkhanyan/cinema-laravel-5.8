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
                            <form method="POST" action="{{ url('/halls/' . $hall['id']) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3 @error('title') text-danger @enderror">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{old('title') ?: $hall['title'] }}">
                                    @error('title')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3  @error('rows') text-danger @enderror">
                                    <label for="rows" class="form-label">Rows</label>
                                    <input type="text" name="rows" class="form-control" id="rows"
                                           value="{{old('rows') ?: $hall['rows']}}">
                                    @error('rows')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3  @error('chairs') text-danger @enderror">
                                    <label for="chairs" class="form-label">Chairs</label>
                                    <input type="text" name="chairs" class="form-control" id="chairs"
                                           value="{{old('chairs') ?: $hall['chairs']}}">
                                    @error('rows')
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
