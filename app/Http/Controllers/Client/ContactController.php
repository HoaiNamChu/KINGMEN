<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Contacts\StoreContactRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    const PATH_VIEW = 'client.contact.';

    public function index(){
        return view(self::PATH_VIEW.__FUNCTION__);
    }

    public function store(StoreContactRequest $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];

        Feedback::query()->create($data);

        return redirect()->route('contact')->with('success', 'Your message has been sent');
    }
}
