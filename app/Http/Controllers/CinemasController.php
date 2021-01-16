<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Hall;
use App\Http\Requests\CinemaStoreRequest;
use App\Http\Requests\CinemaUpdateRequest;
use App\Movie;

class CinemasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cinemas = Cinema::all();

        return view('cinemas.index', ['cinemas' =>  $cinemas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cinemas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CinemaStoreRequest $request)
    {
        $data = $request->only('title', 'address');
        $cinema = Cinema::create($data);

        return redirect('/cinemas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function show(Cinema $cinema)
    {
        return view('cinemas.show', ['cinema' =>  $cinema]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function edit(Cinema $cinema)
    {
        return view('cinemas.edit', ['cinema' =>  $cinema]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function update(CinemaUpdateRequest $request, Cinema $cinema)
    {
        $data = $request->only('title', 'address');
        $cinema->update($data);

        return redirect('/cinemas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cinema  $cinema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cinema $cinema)
    {
        $cinema->delete();

        return redirect('/cinemas');
    }
}
