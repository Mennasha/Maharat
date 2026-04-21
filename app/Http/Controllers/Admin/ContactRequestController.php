<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;

class ContactRequestController extends Controller {
    public function index() {
        $requests = ContactRequest::latest()->paginate(20);
        return view('admin.contact_requests.index', compact('requests'));
    }

    public function markRead(ContactRequest $contactRequest) {
        $contactRequest->update(['is_read' => true]);
        return back()->with('success', 'تم تحديد الرسالة كمقروءة');
    }
}
