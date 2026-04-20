<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller {
    public function index() {
        $workers = Worker::latest()->paginate(20);
        return view('admin.workers.index', compact('workers'));
    }

    public function create() {
        return view('admin.workers.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:100',
            'age' => 'required|integer|min:18|max:60',
            'religion' => 'nullable|string|max:100',
            'marital_status' => 'nullable|string|max:50',
            'language' => 'nullable|string|max:100',
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'experience_years' => 'nullable|integer|min:0',
            'expected_salary' => 'nullable|integer',
            'status' => 'required|in:available,reserved,unavailable',
            'is_featured' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $validated['previous_countries'] = $request->previous_countries
            ? array_filter(explode(',', $request->previous_countries))
            : [];
        $validated['skills'] = $request->skills
            ? array_filter(explode(',', $request->skills))
            : [];
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('workers', 'public');
        }

        Worker::create($validated);

        return redirect()->route('admin.workers.index')
            ->with('success', 'تم إضافة العاملة بنجاح');
    }

    public function edit(Worker $worker) {
        return view('admin.workers.edit', compact('worker'));
    }

    public function update(Request $request, Worker $worker) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:100',
            'age' => 'required|integer|min:18|max:60',
            'religion' => 'nullable|string|max:100',
            'marital_status' => 'nullable|string|max:50',
            'language' => 'nullable|string|max:100',
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'experience_years' => 'nullable|integer|min:0',
            'expected_salary' => 'nullable|integer',
            'status' => 'required|in:available,reserved,unavailable',
            'is_featured' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $validated['previous_countries'] = $request->previous_countries
            ? array_filter(explode(',', $request->previous_countries))
            : [];
        $validated['skills'] = $request->skills
            ? array_filter(explode(',', $request->skills))
            : [];
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('photo')) {
            if ($worker->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($worker->photo);
            }
            $validated['photo'] = $request->file('photo')->store('workers', 'public');
        }

        $worker->update($validated);

        return redirect()->route('admin.workers.index')
            ->with('success', 'تم تحديث بيانات العاملة بنجاح');
    }

    public function destroy(Worker $worker) {
        $worker->delete();
        return redirect()->route('admin.workers.index')
            ->with('success', 'تم حذف العاملة بنجاح');
    }
}
