@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mt-2 mb-2">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card">
                    <div class="card-header">Halls</div>

                    <div class="card-body">
                        <div>
                            @if(count($halls))
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Rows</th>
                                        <th scope="col">Chairs</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($halls as $hall)
                                        <tr>
                                            <td>
                                                {{ $hall['title'] }}
                                            </td>
                                            <td>
                                                {{ $hall['rows'] }}
                                            </td>
                                            <td>
                                                {{ $hall['chairs'] }}
                                            </td>
                                            <td class="text-center">
                                                <a role="button" class="btn btn-primary "
                                                   href="{{ url('/halls/' . $hall['id'] . '/edit') }}">
                                                    Edit
                                                </a>

                                                <a role="button" class="btn btn-info "
                                                   href="{{ url('/halls/' . $hall['id']) }}">
                                                    Show
                                                </a>

                                                <a role="button" class="btn btn-danger " href="javascript:void(0);"
                                                   onclick="$(this).find('form').submit();">
                                                    <form action="{{ url('/halls/' . $hall['id']) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        Delete
                                                    </form>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                No Halls
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <a href="{{url('halls/create')}}" class="btn btn-primary">Add</a>
                </div>
            </div>
        </div>
    </div>
@endsection
