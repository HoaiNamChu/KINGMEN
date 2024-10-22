<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketAdminController extends Controller
{
    //
     // Hiển thị danh sách ticket cho admin
     public function index()
     {
         $tickets = Ticket::all(); // Hoặc phân trang
         return view('admin.tickets.index', compact('tickets'));
     }
 
     // Cập nhật trạng thái ticket
     public function update(Request $request, $id)
     {
         $ticket = Ticket::findOrFail($id);
 
         $request->validate([
             'status' => 'required|in:new,in_progress,resolved,closed',
         ]);
 
         $ticket->status = $request->input('status');
         $ticket->save();
 
         return redirect()->back()->with('success', 'Trạng thái ticket đã được cập nhật!');
     }
 
     // Xóa ticket
     public function destroy($id)
     {
         $ticket = Ticket::findOrFail($id);
         $ticket->delete();
 
         return redirect()->back()->with('success', 'Ticket đã được xóa thành công!');
     }
}
