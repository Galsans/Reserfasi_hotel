<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;

class WelcomeController extends Controller
{
    //function halaman depan 
    public function depan()
    {
        $rooms = Rooms::where('status', 'tersedia')->get();
        // dd($rooms);
        return view('welcome', compact('rooms'));
    }
}
