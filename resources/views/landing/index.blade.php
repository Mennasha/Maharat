@extends('layouts.app')

@section('title', 'وكالة مهارات للاستقدام - الرئيسية')

@section('content')

{{-- Hero Section --}}
<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-gray-900">
    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-bl from-blue-900 via-blue-800 to-green-900 opacity-90"></div>
    {{-- Decorative circles --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500 rounded-full opacity-10 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-green-500 rounded-full opacity-10 translate-y-1/2 -translate-x-1/3"></div>

    <div class="relative z-10 max-w-4xl mx-auto text-center px-4 py-24">
        <span class="inline-block bg-white/10 text-white text-sm px-4 py-1.5 rounded-full mb-6 border border-white/20 backdrop-blur-sm">
            ✨ وكالة موثوقة منذ سنوات
        </span>
        <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 leading-tight">
            وكالة مهارات<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-l from-green-300 to-blue-300">للاستقدام</span>
        </h1>
        <p class="text-xl md:text-2xl text-blue-100/90 mb-10 max-w-2xl mx-auto leading-relaxed">
            نوفر لك أفضل العمالة المنزلية المدربة من جميع أنحاء العالم بضمان الجودة وسرعة الوصول
        </p>
        <div class="flex flex-wrap gap-4 justify-center mb-12">
            <a href="{{ route('workers.index') }}" class="bg-white text-blue-800 px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-50 transition shadow-lg hover:shadow-xl">
                🔍 استعراض العمالة
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white/60 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition backdrop-blur-sm">
                📞 تواصل معنا
            </a>
        </div>
        {{-- Quick search --}}
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 max-w-xl mx-auto border border-white/20">
            <form action="{{ route('workers.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <select name="nationality" class="flex-1 bg-white border-0 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm">
                    <option value="">🌍 اختر الجنسية</option>
                    @foreach($featuredWorkers->pluck('nationality')->unique()->filter() as $nat)
                        <option value="{{ $nat }}">{{ $nat }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-400 transition text-sm whitespace-nowrap">
                    ابحث الآن
                </button>
            </form>
        </div>
    </div>

    {{-- Wave --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 60L1440 60L1440 30C1200 60 960 0 720 20C480 40 240 0 0 30L0 60Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

{{-- Stats Section --}}
<section class="bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition" data-animate-stat>
                <div class="text-5xl font-extrabold text-blue-600 mb-2 stat-number" data-target="{{ $stats['available_workers'] }}">0</div>
                <div class="text-gray-500 font-medium">عاملة متاحة الآن</div>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition" data-animate-stat>
                <div class="text-5xl font-extrabold text-green-600 mb-2 stat-number" data-target="{{ $stats['happy_clients'] }}">0</div>
                <div class="text-gray-500 font-medium">عميل سعيد</div>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition" data-animate-stat>
                <div class="text-5xl font-extrabold text-purple-600 mb-2 stat-number" data-target="{{ $stats['avg_arrival_days'] }}">0</div>
                <div class="text-gray-500 font-medium">يوم متوسط الوصول</div>
            </div>
        </div>
    </div>
</section>

{{-- Featured Workers --}}
@if($featuredWorkers->count())
<section class="py-16 px-4 max-w-7xl mx-auto">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">العمالة المميزة</h2>
        <p class="text-gray-500">اختيار من أفضل العمالة المتاحة لدينا</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($featuredWorkers as $worker)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden group">
            <div class="relative h-52 bg-gradient-to-b from-gray-100 to-gray-200 overflow-hidden">
                @if($worker->photo)
                    <img src="{{ asset('storage/'.$worker->photo) }}" alt="{{ $worker->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-6xl">👩</div>
                @endif
                {{-- Status Badge --}}
                <span class="absolute top-3 start-3 text-xs font-bold px-2.5 py-1 rounded-full
                    {{ $worker->status === 'available' ? 'bg-green-500 text-white' : ($worker->status === 'reserved' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white') }}">
                    {{ $worker->status_label }}
                </span>
                @if($worker->is_featured)
                <span class="absolute top-3 end-3 bg-yellow-400 text-yellow-900 text-xs font-bold px-2.5 py-1 rounded-full">⭐ مميزة</span>
                @endif
            </div>
            <div class="p-5">
                <h3 class="font-bold text-lg text-gray-800 mb-1">{{ $worker->name }}</h3>
                <div class="flex flex-wrap gap-2 text-sm text-gray-500 mb-3">
                    <span class="flex items-center gap-1">🌍 {{ $worker->nationality }}</span>
                    <span class="flex items-center gap-1">🎂 {{ $worker->age }} سنة</span>
                </div>
                @if($worker->skills && is_array($worker->skills) && count($worker->skills))
                <div class="flex flex-wrap gap-1 mb-3">
                    @foreach(array_slice($worker->skills, 0, 3) as $skill)
                    <span class="bg-blue-50 text-blue-700 text-xs px-2 py-0.5 rounded-full">{{ $skill }}</span>
                    @endforeach
                </div>
                @endif
                @if($worker->expected_salary)
                    <p class="text-blue-600 font-bold mb-3">{{ number_format($worker->expected_salary) }} ريال<span class="text-xs font-normal text-gray-400">/شهر</span></p>
                @endif
                <a href="{{ route('workers.show', $worker) }}"
                   class="block text-center {{ $worker->status === 'available' ? 'bg-blue-600 hover:bg-blue-700' : 'bg-gray-400 cursor-default' }} text-white py-2.5 rounded-xl transition font-medium text-sm">
                    {{ $worker->status === 'available' ? 'عرض الملف والحجز' : 'عرض الملف' }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="text-center mt-10">
        <a href="{{ route('workers.index') }}" class="inline-flex items-center gap-2 bg-gray-800 text-white px-8 py-3 rounded-xl hover:bg-gray-900 transition font-medium">
            عرض جميع العمالة
            <svg class="w-4 h-4 rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>
@endif

{{-- Why Us --}}
<section class="bg-blue-50 py-16 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-3">لماذا نحن؟</h2>
            <p class="text-gray-500">نتميز عن غيرنا بمجموعة من المزايا الفريدة</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition hover:-translate-y-1">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">⚡</div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">سرعة الاستقدام</h3>
                <p class="text-gray-500 text-sm leading-relaxed">نضمن وصول العاملة في أقل من 30 يوم عمل مع متابعة مستمرة لكل خطوة</p>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition hover:-translate-y-1">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">🛡️</div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">ضمان العمالة</h3>
                <p class="text-gray-500 text-sm leading-relaxed">نقدم ضمان استبدال مجاني لمدة 3 أشهر في حال عدم التوافق مع العاملة</p>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition hover:-translate-y-1">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">🎯</div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">اختيار دقيق</h3>
                <p class="text-gray-500 text-sm leading-relaxed">نختار العمالة بعناية فائقة بعد فحص شامل للمهارات والسيرة الذاتية</p>
            </div>
        </div>
    </div>
</section>

{{-- How It Works - Visual Timeline --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-3">خطوات العمل</h2>
            <p class="text-gray-500">عملية سهلة وشفافة من البداية للنهاية</p>
        </div>
        <div class="relative">
            {{-- Connector line (desktop) --}}
            <div class="hidden md:block absolute top-10 right-[10%] left-[10%] h-0.5 bg-gradient-to-l from-purple-400 via-green-400 to-blue-400"></div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                @php
                    $steps = [
                        ['num'=>'1','color'=>'bg-blue-600','light'=>'bg-blue-50','icon'=>'🔍','title'=>'اختر العاملة','desc'=>'تصفح ملفات العمالة المتاحة واختر المناسبة لاحتياجاتك'],
                        ['num'=>'2','color'=>'bg-green-600','light'=>'bg-green-50','icon'=>'📄','title'=>'وقّع العقد','desc'=>'نوقع عقداً رسمياً يضمن حقوقك ويحدد جميع الشروط بوضوح'],
                        ['num'=>'3','color'=>'bg-purple-600','light'=>'bg-purple-50','icon'=>'🏠','title'=>'استقبل العاملة','desc'=>'نتولى جميع الإجراءات ونسلمك العاملة على باب منزلك'],
                    ];
                @endphp
                @foreach($steps as $step)
                <div class="text-center relative">
                    <div class="relative inline-flex items-center justify-center">
                        <div class="w-20 h-20 {{ $step['light'] }} rounded-2xl flex items-center justify-center text-4xl mx-auto mb-4 relative z-10">
                            {{ $step['icon'] }}
                        </div>
                        <span class="absolute -top-2 -start-2 w-7 h-7 {{ $step['color'] }} text-white rounded-full flex items-center justify-center text-xs font-bold z-20">{{ $step['num'] }}</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-gray-800">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('workers.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 transition font-bold">
                ابدأ الآن
            </a>
        </div>
    </div>
</section>

{{-- Services Preview --}}
@if($services->count())
<section class="bg-gray-900 text-white py-16 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold mb-3">خدماتنا</h2>
            <p class="text-gray-400">مجموعة متكاملة من الخدمات لتلبية احتياجاتك</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($services as $service)
            <div class="bg-gray-800 rounded-2xl p-6 text-center hover:bg-gray-700 transition hover:-translate-y-1 border border-gray-700">
                @if($service->icon)
                    <div class="text-4xl mb-3">{{ $service->icon }}</div>
                @endif
                <h3 class="font-bold text-lg mb-2">{{ $service->title }}</h3>
                @if($service->description)
                    <p class="text-gray-400 text-sm leading-relaxed">{{ $service->description }}</p>
                @endif
                @if($service->price)
                    <p class="text-green-400 font-bold mt-3 text-lg">{{ number_format($service->price) }} <span class="text-sm font-normal">ريال</span></p>
                @endif
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('services') }}" class="bg-blue-500 text-white px-8 py-3 rounded-xl hover:bg-blue-400 transition font-bold">
                جميع الخدمات
            </a>
        </div>
    </div>
</section>
@endif

{{-- Testimonials Slider --}}
@if($testimonials->count())
<section class="py-16 px-4 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-3">آراء عملائنا</h2>
            <p class="text-gray-500">ما يقوله عملاؤنا عن تجربتهم معنا</p>
        </div>
        <div class="relative overflow-hidden" id="testimonials-slider">
            <div class="flex transition-transform duration-500 ease-in-out" id="testimonials-track">
                @foreach($testimonials as $testimonial)
                <div class="min-w-full px-2">
                    <div class="bg-white rounded-2xl p-8 shadow-md max-w-2xl mx-auto text-center">
                        <div class="flex justify-center mb-4">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <span class="text-yellow-400 text-2xl">★</span>
                            @endfor
                            @for($i = $testimonial->rating; $i < 5; $i++)
                                <span class="text-gray-200 text-2xl">★</span>
                            @endfor
                        </div>
                        <p class="text-gray-600 leading-relaxed mb-6 text-lg">"{{ $testimonial->content }}"</p>
                        <div class="flex items-center justify-center gap-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-lg">
                                {{ mb_substr($testimonial->client_name, 0, 1) }}
                            </div>
                            <span class="font-bold text-gray-700 text-lg">{{ $testimonial->client_name }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if($testimonials->count() > 1)
        <div class="flex items-center justify-center gap-4 mt-6">
            <button id="testimonial-prev" class="w-10 h-10 bg-white rounded-full shadow flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
            <div class="flex gap-2" id="testimonial-dots"></div>
            <button id="testimonial-next" class="w-10 h-10 bg-white rounded-full shadow flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
        </div>
        @endif
    </div>
</section>
@endif

{{-- Partners --}}
@if($partners->count())
<section class="bg-white py-12 px-4">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">شركاؤنا</h2>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach($partners as $partner)
            <div class="bg-gray-50 border border-gray-200 rounded-xl px-6 py-3 hover:shadow-md transition hover:border-blue-300 flex items-center gap-3">
                @if($partner->logo)
                    <img src="{{ asset('storage/'.$partner->logo) }}" class="h-8 object-contain">
                @else
                    <span class="text-2xl">🤝</span>
                @endif
                <div>
                    <div class="font-bold text-gray-700 text-sm">{{ $partner->name }}</div>
                    @if($partner->country)
                        <div class="text-xs text-gray-400">{{ $partner->country }}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
// Stats Count-Up Animation with Intersection Observer
document.addEventListener('DOMContentLoaded', function () {
    var statEls = document.querySelectorAll('[data-animate-stat]');
    if (!statEls.length) return;

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting && !entry.target.dataset.counted) {
                entry.target.dataset.counted = '1';
                var numEl = entry.target.querySelector('.stat-number');
                if (!numEl) return;
                var target = parseInt(numEl.dataset.target, 10);
                var start = 0;
                var duration = 1800;
                var startTime = null;
                function step(ts) {
                    if (!startTime) startTime = ts;
                    var progress = Math.min((ts - startTime) / duration, 1);
                    var ease = 1 - Math.pow(1 - progress, 3);
                    numEl.textContent = Math.floor(ease * target) + (progress < 1 ? '' : '+');
                    if (progress < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }
        });
    }, { threshold: 0.3 });

    statEls.forEach(function (el) { observer.observe(el); });
});

// Testimonials Slider
(function () {
    var track = document.getElementById('testimonials-track');
    var dotsContainer = document.getElementById('testimonial-dots');
    if (!track) return;

    var slides = track.children.length;
    var current = 0;

    // Build dots
    if (dotsContainer) {
        for (var i = 0; i < slides; i++) {
            var d = document.createElement('button');
            d.className = 'w-2.5 h-2.5 rounded-full transition-colors duration-300 ' + (i === 0 ? 'bg-blue-600' : 'bg-gray-300');
            d.dataset.idx = i;
            d.addEventListener('click', function () { goTo(parseInt(this.dataset.idx)); });
            dotsContainer.appendChild(d);
        }
    }

    function goTo(idx) {
        current = (idx + slides) % slides;
        if (document.documentElement.dir === 'rtl') {
            track.style.transform = 'translateX(' + (current * 100) + '%)';
        } else {
            track.style.transform = 'translateX(-' + (current * 100) + '%)';
        }
        if (dotsContainer) {
            Array.from(dotsContainer.children).forEach(function (d, i) {
                d.className = 'w-2.5 h-2.5 rounded-full transition-colors duration-300 ' + (i === current ? 'bg-blue-600' : 'bg-gray-300');
            });
        }
    }

    var nextBtn = document.getElementById('testimonial-next');
    var prevBtn = document.getElementById('testimonial-prev');
    if (nextBtn) nextBtn.addEventListener('click', function () { goTo(current + 1); });
    if (prevBtn) prevBtn.addEventListener('click', function () { goTo(current - 1); });

    // Auto-advance
    setInterval(function () { goTo(current + 1); }, 5000);
})();
</script>
@endpush
