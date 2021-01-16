@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mt-2 mb-2">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card">
                    <div class="card-header">Sessions</div>

                    <div class="card-body">
                        <div>
                            @if(count($sessions))
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Cinema</th>
                                        <th scope="col">Movie</th>
                                        <th scope="col">Hall</th>
                                        <th scope="col">Start Time</th>
                                        <th scope="col">End Time</th>
                                        <th scope="col" class="text-center">Actions</th>
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
                                                <a role="button" class="btn btn-primary "
                                                   href="{{ url('/sessions/' . $session['id'] . '/edit') }}">
                                                    Edit
                                                </a>

                                                <a role="button" class="btn btn-info "
                                                   href="{{ url('/sessions/' . $session['id']) }}">
                                                    Show
                                                </a>

                                                <a role="button" class="btn btn-danger " href="javascript:void(0);"
                                                   onclick="$(this).find('form').submit();">
                                                    <form action="{{ url('/sessions/' . $session['id']) }}"
                                                          method="POST">
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
                                No sessions
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#selectCinemaModal">
                        Add
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="selectCinemaModal" tabindex="-1" aria-labelledby="selectCinemaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="GET" class="update-form" action="{{url('sessions/create')}}">
                    <input type="hidden" id="cinema_id" name="id" value="{{$cinemas[0]['id']}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <select class="custom-select cinema-select" name="cinema_id" aria-label="Select cinema">
                                @foreach($cinemas as $cinema)
                                    <option value="{{$cinema['id']}}">{{$cinema['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function() {
            $('.cinema-select').on('change', function() {
                var id = $(this).val();
                $('#cinema_id').val(id);
            });
        });
    </script>
@endsection
