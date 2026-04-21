<?php
namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Service;
use App\Models\NationalityPrice;

class LandingController extends Controller {
    public function index() {
        $featuredWorkers = Worker::where('is_featured', true)->where('status','available')->take(6)->get();
        $testimonials = Testimonial::where('is_active', true)->take(6)->get();
        $partners = Partner::where('is_active', true)->get();
        $services = Service::where('is_active', true)->get();
        $nationalities = Worker::where('is_featured', true)->where('status','available')
            ->distinct()->pluck('nationality')->filter()->values();
        $stats = [
            'available_workers' => Worker::where('status','available')->count(),
            'happy_clients' => \App\Models\Client::count(),
            'avg_arrival_days' => 21,
        ];
        return view('landing.index', compact('featuredWorkers','testimonials','partners','services','stats','nationalities'));
    }
}
