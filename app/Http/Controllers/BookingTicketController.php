<?php

namespace App\Http\Controllers;

use App\Models\BookingTicket;
use App\Models\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingTicketController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('limit', 10);
        $data = BookingTicket::paginate($perPage)->appends($request->query());
        return view('admin.booking-ticket.view', compact('data'));
    }

    
}
