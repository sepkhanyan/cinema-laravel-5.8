<?php

namespace App\Http\Controllers;

use App\Cinema;
use App\Hall;
use App\Http\Requests\HallStoreRequest;
use Illuminate\Http\Request;

class HallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::all();

        return view('halls.index', ['halls' =>  $halls]);
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
        return view('halls.create', ['cinemas' =>  $cinemas]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HallStoreRequest $request)
    {
        $data = $request->only('title', 'cinema_id', 'rows', 'chairs');
        $hall = Hall::create($data);

        return redirect('/halls');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show(Hall $hall)
    {
        $hall->load('cinema');

        return view('halls.show', ['hall' =>  $hall]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function edit(Hall $hall)
    {
        return view('halls.edit', ['hall' =>  $hall]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        $data = $request->only('title', 'cinema_id', 'rows', 'chairs');
        $hall->update($data);

        return redirect('/halls');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        $hall->delete();

        return redirect('/halls');
    }
}
