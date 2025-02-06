<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rooms;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

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
        $kode_bookings = 'BOOK-' . date('Ymd') . '-' . rand(1000, 9999);
        $rooms = Rooms::findOrFail($id);
        $users = Auth::user()->id;
        return view('admin.bookings.create', compact('rooms', 'users','kode_bookings'));
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validate = Validator::make([
    //         "kode_bookings" => 'required',
    //         "user_id" => 'required',
    //         "room_id" => 'required',
    //         "check_in" => 'required',
    //         "status" => 'required ',
    //         "check_out" => 'required',
    //         "qty_person" => 'required',
    //     ]);

    //     if ($validate->fails()) {
    //         return redirect()->back()->withErrors($validate->errors())->withInput();
    //     }

    //     $input = $request->all();
    //     $bookings = Booking::create($input);

    //     Alert::success('Berhasil', 'Berhasil Menyimpan Data');
    //     return redirect()->route('admin.bookings.index');
    // }

    public function store(Request $request)
    {
        $request->validate([
            "user_id" => 'required|exists:users,id',
            "room_id" => 'required|exists:rooms,id',
            "check_in" => 'required|date|after_or_equal:today',
            "check_out" => 'required|date|after:check_in',
            "qty_person" => 'required|integer|min:1',
            "status" => 'required|in:pending,confirm,cancelled'
        ]);

        // Generate kode booking otomatis berdasarkan tanggal check-in
        $kode_booking = 'BOOK-' . date('Ymd-His', strtotime($request->check_in));

        // Hitung total harga berdasarkan jumlah malam
        $room = Room::findOrFail($request->room_id);
        $total_days = \Carbon\Carbon::parse($request->check_in)->diffInDays(\Carbon\Carbon::parse($request->check_out)) ?: 1;
        $total_price = $total_days * $room->price;

        // Simpan data booking
        Booking::create([
            "kode_bookings" => $kode_booking,
            "user_id" => $request->user_id,
            "room_id" => $request->room_id,
            "check_in" => $request->check_in,
            "check_out" => $request->check_out,
            "qty_person" => $request->qty_person,
            "status" => $request->status,
            "total_price" => $total_price
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibuat dengan kode ' . $kode_booking);
    }

    public function confirm(Request $request,$id)
    {
        $rooms = Rooms::findOrFail($id);
        // $users = Auth::user()->id;
        // $kode_bookings = 'BOOK-' . date('Ymd') . '-' . rand(1000, 9999);
        
        // $bookings->status = 'confirm';
        // $bookings->save();
        

        Alert::success('Berhasil', 'Berhasil Mengkonfirmasi Booking');
        return view('admin.bookings.check', compact('rooms'));
        // return redirect()->route('admin.bookings.check');
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
