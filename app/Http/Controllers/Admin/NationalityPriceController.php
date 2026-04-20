<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NationalityPrice;
use Illuminate\Http\Request;

class NationalityPriceController extends Controller {
    public function index() {
        $prices = NationalityPrice::latest()->paginate(20);
        return view('admin.prices.index', compact('prices'));
    }

    public function create() {
        return view('admin.prices.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nationality' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'notes' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        NationalityPrice::create($validated);
        return redirect()->route('admin.prices.index')->with('success', 'تم إضافة السعر بنجاح');
    }

    public function edit(NationalityPrice $price) {
        return view('admin.prices.edit', compact('price'));
    }

    public function update(Request $request, NationalityPrice $price) {
        $validated = $request->validate([
            'nationality' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'notes' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $price->update($validated);
        return redirect()->route('admin.prices.index')->with('success', 'تم تحديث السعر بنجاح');
    }

    public function destroy(NationalityPrice $price) {
        $price->delete();
        return redirect()->route('admin.prices.index')->with('success', 'تم حذف السعر بنجاح');
    }
}
