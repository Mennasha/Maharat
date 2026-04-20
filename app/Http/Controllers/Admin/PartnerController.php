<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller {
    public function index() {
        $partners = Partner::latest()->paginate(20);
        return view('admin.partners.index', compact('partners'));
    }

    public function create() {
        return view('admin.partners.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|max:2048',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('partners', 'public');
        }

        Partner::create($validated);
        return redirect()->route('admin.partners.index')->with('success', 'تم إضافة الشريك بنجاح');
    }

    public function edit(Partner $partner) {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|max:2048',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo')) {
            if ($partner->logo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($partner->logo);
            }
            $validated['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($validated);
        return redirect()->route('admin.partners.index')->with('success', 'تم تحديث بيانات الشريك بنجاح');
    }

    public function destroy(Partner $partner) {
        if ($partner->logo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();
        return redirect()->route('admin.partners.index')->with('success', 'تم حذف الشريك بنجاح');
    }
}
