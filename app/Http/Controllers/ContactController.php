<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Pesan Anda telah terkirim.',
        ]);
    }

    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('messages', compact('messages'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}

