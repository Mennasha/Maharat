<?php
namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller {
    public function index(Request $request) {
        $query = Worker::query();
        if ($request->nationality) $query->where('nationality', $request->nationality);
        if ($request->religion) $query->where('religion', $request->religion);
        if ($request->marital_status) $query->where('marital_status', $request->marital_status);
        if ($request->language) $query->where('language', $request->language);
        if ($request->min_salary) $query->where('expected_salary', '>=', $request->min_salary);
        if ($request->max_salary) $query->where('expected_salary', '<=', $request->max_salary);
        $workers = $query->paginate(12);
        $nationalities = Worker::distinct()->pluck('nationality');
        return view('workers.index', compact('workers','nationalities'));
    }

    public function show(Worker $worker) {
        return view('workers.show', compact('worker'));
    }
}
