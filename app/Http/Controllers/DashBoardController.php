<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    //
    public function dashboardDepan()
    {
        $rooms = ['Standard', 'Deluxe', 'Suite'];
        return view('welcome', compact('rooms'));
    }
}
