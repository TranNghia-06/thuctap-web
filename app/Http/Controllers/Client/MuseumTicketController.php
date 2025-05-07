<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class MuseumTicketController extends Controller
{
    // Hiển thị form tạo vé
    public function create()
    {
        return view('client.museum_ticket.create');
    }

    // Lưu thông tin vé mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'visit_date' => 'required|date|after_or_equal:today',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticketPrice = 50000; // Giá vé cố định

        // Tạo vé mới
        Ticket::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'visit_date' => $request->visit_date,
            'quantity' => $request->quantity,
            'price' => $ticketPrice,
        ]);

        return redirect()->route('client.museum_ticket.create')->with('success', 'Đặt vé thành công!');
    }

    // Hiển thị lịch sử đặt vé
    public function history()
    {
        // Lấy các vé đã đặt của người dùng hiện tại
        $tickets = Ticket::where('email', auth()->user()->email)->get();
        return view('client.museum_ticket.history', compact('tickets'));
    }
}
