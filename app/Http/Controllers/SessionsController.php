<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Hall;
use App\Http\Requests\SessionStoreRequest;
use App\Movie;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::query()->with('movie', 'hall', 'cinema')->get();
        $cinemas = Cinema::all();

        return view('sessions.index', ['sessions' =>  $sessions, 'cinemas' => $cinemas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $movies = Movie::where('cinema_id', $request['id'])->get();
        $halls = Hall::where('cinema_id', $request['id'])->get();
        $cinemas = Cinema::all();
        $cinema = Cinema::find($request['id']);


        if(!count($halls)){
            session(['not_created' => 'Did not added Hall for this Cinema.']);
            return view('halls.create', ['cinemas' =>  $cinemas]);
        }

        if(!count($movies)){
            session(['not_created' => 'Did not added Movie for this Cinema.']);
            return view('movies.create', ['cinemas' =>  $cinemas]);
        }


        return view('sessions.create', ['halls' =>  $halls, 'movies' => $movies, 'cinema' => $cinema]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SessionStoreRequest $request)
    {
        $data = $request->only('cinema_id', 'movie_id', 'hall_id', 'start_time');
        $movie = Movie::find($data['movie_id']);
        $endTime = strtotime($data['start_time']) + 60 * $movie['duration'];
        $endTime = date('Y-m-d H:i:s', $endTime);
        $data['end_time'] = $endTime;

        $start = Carbon::parse($data['start_time'])->subMinutes(15);
        $end = Carbon::parse($endTime)->addMinutes(15);

        $session = Session::where([['end_time', '>', $start], ['start_time', '<', $start]])
            ->orWhere([['start_time', '<', $end], ['end_time', '>', $end]])
            ->first();

        if($session){
            session(['active_session' => 'There is active session at selected time.']);
            return redirect()->back();
        }


        $session = Session::create($data);

        return redirect('/sessions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        $session->load('movie.cinema', 'hall');

        return view('sessions.show', ['session' =>  $session]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        $movies = Movie::all();
        $halls = Hall::all();

        return view('sessions.edit', ['session' => $session,'halls' => $halls,'movies' =>  $movies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(SessionStoreRequest $request, Session $session)
    {
        $data = $request->only('cinema_id', 'movie_id', 'hall_id', 'start_time');

        $movie = Movie::find($data['movie_id']);
        $endTime = strtotime($data['start_time']) + 60 * $movie['duration'];
        $endTime = date('Y-m-d H:i:s', $endTime);
        $data['end_time'] = $endTime;

        $start = Carbon::parse($data['start_time'])->subMinutes(15);
        $end = Carbon::parse($endTime)->addMinutes(15);

        $oldSession = Session::where('id', '!=', $session['id']);
        $oldSession = $oldSession->where([['end_time', '>', $start], ['start_time', '<', $start]])
            ->orWhere([['start_time', '<', $end], ['end_time', '>', $end]])
            ->first();

        if($oldSession){
            session(['active_session' => 'There is active session at selected time.']);
            return redirect()->back();
        }

        $session->update($data);

        return redirect('/sessions');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $session->delete();

        return redirect('/sessions');
    }
}
