<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    // Hiển thị danh sách vé
    public function index()
    {
        $tickets = Ticket::all(); // Lấy tất cả vé tham quan
        return view('admin.ticketmuseum.index', compact('tickets'));
    }

    // Chấp nhận vé
    public function accept($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $ticket->status = 'confirmed';
            $ticket->save();
            return redirect()->route('admin.ticketmuseum')->with('success', 'Vé đã được chấp nhận!');
        }
        return redirect()->route('admin.ticketmuseum')->with('error', 'Không tìm thấy vé!');
    }

    // Từ chối vé
    public function reject($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $ticket->status = 'canceled';
            $ticket->save();
            return redirect()->route('admin.ticketmuseum')->with('success', 'Vé đã bị từ chối!');
        }
        return redirect()->route('admin.ticketmuseum')->with('error', 'Không tìm thấy vé!');
    }

    // Đánh dấu đã thanh toán
    public function markAsPaid($id)
    {
        $ticket = Ticket::find($id);
        if ($ticket) {
            $ticket->status = 'paid'; //  chuỗi hợp lệ
            $ticket->save();
            return redirect()->route('admin.ticketmuseum')->with('success', 'Vé đã được đánh dấu là đã thanh toán!');
        }
        return redirect()->route('admin.ticketmuseum')->with('error', 'Không tìm thấy vé!');
    }
}
