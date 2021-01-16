<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Movie;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        return view('movies.index', ['movies' =>  $movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cinemas = Cinema::all();
        if(!count($cinemas)){
            session(['not_created' => 'You has not created Cinema yet.']);
            return view('cinemas.create');

        }
        return view('movies.create', ['cinemas' =>  $cinemas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieStoreRequest $request)
    {
        $data = $request->only('title', 'duration', 'description', 'cinema_id');
        $poster = $request->file('poster');
        $name = time() . '.' . $poster->getClientOriginalExtension();
        $request->file('poster')->storeAs('/public', $name);
        $url = Storage::url($name);
        $data['poster'] = $url;
        $cinema = Movie::create($data);

        return redirect('/movies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show', ['movie' =>  $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', ['movie' =>  $movie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        $data = $request->only('title', 'duration', 'description', 'cinema_id');
        if($request->hasFile('poster')){
            $poster = $request->file('poster');
            $name = time() . '.' . $poster->getClientOriginalExtension();
            $request->file('poster')->storeAs('/public', $name);
            $url = Storage::url($name);
            $data['poster'] = $url;
        }
        $movie->update($data);

        return redirect('/movies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect('/movies');
    }
}
