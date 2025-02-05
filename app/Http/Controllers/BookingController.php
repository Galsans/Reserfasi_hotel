<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rooms;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        // $bookings = $id ? Booking::findOrFail($id) : new Booking();
        // $rooms = Rooms::where('status', 'tersedia')->get();
        $rooms = Rooms::findOrFail($id);
        return view('admin.bookings.create', compact('rooms'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make([
            "kode_bookings" => 'required',
            "user_id" => 'required',
            "room_id" => 'required',
            "check_in" => 'required',
            "status" => 'required ',
            "check_out" => 'required',
            "qty_person" => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $input = $request->all();
        $bookings = Booking::create($input);

        Alert::success('Berhasil', 'Berhasil Menyimpan Data');
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookings = Booking::find($id);
        return view('admin.bookings.show', compact('bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bookings = Booking::find($id);
        return view('admin.bookings.edit', compact('bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            "kode_bookings" => 'required',
            "user_id" => 'required',
            "room_id" => 'required',
            "check_in" => 'required',
            "check_out" => 'required',
            "qty_person" => 'required',
            "status" => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $bookings = Booking::find($id);
        $input = $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
