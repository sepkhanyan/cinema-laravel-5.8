@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-2 mb-2">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card">
                    <div class="card-header">New Cinema</div>

                    <div class="card-body">
                        <div>
                            <form method="POST" action="{{ url('/cinemas') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 @error('title') text-danger @enderror">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{old('title')}}">
                                    @error('title')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3  @error('address') text-danger @enderror">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                           value="{{old('address')}}">
                                    @error('address')
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
