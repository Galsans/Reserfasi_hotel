<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Rooms::all();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "no_room" => ['unique:rooms,no_room,required'],
            "facilities" => ['required', 'max:750'],
            "type_room" => ['required', 'in:suite,deluxe,standard'],
            "price" => ['required'],
            "status" => ['required', 'in:tersedia,terisi'],
            "img" => ['mimes:png,jpg,jpeg', 'required', 'max:5120'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $input = $request->all();
        $input['img'] = $request->file('img')->store('public/rooms');
        $input['no_room'] = Str::random(5);

        Rooms::create($input);

        Alert::success('Berhasil', 'Berhasil Menyimpan Data');
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rooms $rooms, $id)
    {
        $rooms = Rooms::find($id);
        return view('admin.rooms.show', compact('rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rooms $rooms, $id)
    {
        $rooms = Rooms::find($id);
        return view('admin.rooms.edit', compact('rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validate = Validator::make($request->all(), [
            "no_room" => ['unique:rooms,no_room,' . $id], // Tambahkan pengecualian ID saat validasi unique
            // "facilities" => [,
            "type_room" => ['in:suite,deluxe,standard'],
            "status" => ['in:tersedia,terisi'],
            "img" => ['nullable', 'mimes:png,jpg,jpeg'], // Tambahkan 'file' agar validasi lebih kuat
        ]);

        // Kembalikan ke halaman sebelumnya jika validasi gagal
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Temukan data room berdasarkan ID
        $rooms = Rooms::findOrFail($id); // Gunakan `findOrFail` untuk menghindari error jika ID tidak ditemukan

        // Ambil semua input kecuali file `img`
        // $input = $request->except(['img']);
        $rooms->no_room = $request->input('no_room');
        $rooms->facilities = $request->input('facilities');
        $rooms->type_room = $request->input('type_room');
        $rooms->price = $request->input('price');
        $rooms->status = $request->input('status');
        $input['no_room'] = Str::random(5);

        // Proses file upload jika ada
        if ($request->hasFile('img')) {
            // Delete the old image if exists
            if ($rooms->img) {
                Storage::delete($rooms->img);
            }
            // Store the new image
            $rooms->img = $request->file('img')->store('public/rooms');
        }
        // Update data room
        $rooms->save();

        // Redirect dengan pesan sukses
        Alert::success('Berhasil', 'Berhasil Mengubah Data');
        return redirect()->route('rooms.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rooms $rooms, $id)
    {
        $rooms = Rooms::find($id);
        if ($rooms->img) {
            Storage::delete($rooms->img);
        }
        $rooms->delete();
        Alert::success('Berhasil', 'Berhasil Menghapus Data');
        return redirect()->route('rooms.index');
    }
}
