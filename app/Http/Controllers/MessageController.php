<?php

namespace App\Http\Controllers;

use App\Events\MessageReceived;
use Illuminate\Http\Request;

class MessageController extends Controller
{


    public function store(Request $request)
    {
        try {
            $payload = $request->validate([
                'message' => 'required',
                'id' => 'required',
            ]);
            MessageReceived::dispatch($payload['message'], $payload['id']);
            response()->json(['message' => 'Message sent successfully']);
            return redirect()->back();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
