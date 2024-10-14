<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact'); // Pastikan ada file contact.blade.php di folder views
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
            'attachments.*' => 'file|max:20480', // 20MB max per file
        ]);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('contact_attachments');
                // Save $path to database or process as needed
            }
        }

        // Process the form submission (e.g., send an email, save to database, etc.)
        // For now, we'll just redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}

