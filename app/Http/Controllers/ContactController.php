<?php
namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller {
    public function index() {
        return view('pages.contact');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactRequest::create($request->only('name', 'phone', 'email', 'subject', 'message'));

        return back()->with('success', 'تم إرسال رسالتك بنجاح، سنرد عليك في أقرب وقت.');
    }
}
