<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketController extends Controller
{
    //
    // Hiển thị form gửi ticket
    public function create()
    {
        return view('client.tickets.create');
    }

    // Lưu ticket mới
    public function store(Request $request)
    {

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để gửi yêu cầu!');
        }

        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $ticket = new Ticket();
        $ticket->user_id = auth()->id(); // Hoặc lấy ID từ session
        $ticket->subject = $request->input('subject');
        $ticket->message = $request->input('message');
        $ticket->save();
//lỗi phát được phát không 
        return redirect()->route('/')->with('success', 'Yêu cầu của bạn đã được gửi thành công!');
    }
}
