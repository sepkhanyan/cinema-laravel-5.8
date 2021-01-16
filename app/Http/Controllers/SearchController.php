<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchController extends Controller
{
   public function index()
   {
       return view('customers.index');
   }

    public function search(Request $request)
    {

        $like = $request['title'] . '%';
        $sessions = Session::where('start_time', '>', Carbon::now())
            ->whereHas('movie', function ($query) use($like){
            $query->where('title', 'like', $like);
        })->get();

        session([
            'upcoming' => $sessions,
            'title' => $request['title']
        ]);

        return view('customers.index', ['sessions' => $sessions]);
    }

    public function booking($id)
    {
        $session = Session::where('id', $id)->with('movie', 'hall', 'cinema')->first();
        $rows = range(1, $session->hall['rows']);
        $chairs = range(1, $session->hall['chairs']);
        $bookings = Booking::where('session_id', $id)->get();

        return view('customers.booking', ['session' =>  $session, 'rows' => $rows, 'chairs' => $chairs, 'bookings' => $bookings]);
    }

    public function book(Request $request, $id)
    {
        $bookings = Booking::where('session_id', $id)->get();
        $sits = $request['sit'];
        $data = [];
        foreach ($sits as $sit){
            if($bookings->contains('sit', $sit)){
                session(['booked' => 'Already booked.']);
                return redirect()->back();
            }
            $data['session_id'] = $id;
            $data['user_id'] = auth()->user()->id;
            $data['sit'] = $sit;

            $booking = Booking::create($data);

            return view('customers.index');
        }
    }
}
