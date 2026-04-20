@extends('layouts.app')

@section('title', 'وكالة مهارات للاستقدام - الرئيسية')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-l from-blue-700 to-green-600 text-white py-24 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 leading-tight">وكالة مهارات للاستقدام</h1>
        <p class="text-xl md:text-2xl text-blue-100 mb-8">نوفر لك أفضل العمالة المنزلية المدربة من جميع أنحاء العالم</p>
        <div class="bg-white rounded-2xl p-6 shadow-xl max-w-2xl mx-auto">
            <form action="{{ route('workers.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                <select name="nationality" class="flex-1 border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">اختر الجنسية</option>
                    @foreach($featuredWorkers->pluck('nationality')->unique() as $nat)
                        <option value="{{ $nat }}">{{ $nat }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                    🔍 ابحث الآن
                </button>
            </form>
        </div>
    </div>
</section>

{{-- Stats Section --}}
<section class="bg-white py-10 shadow-sm">
    <div class="max-w-5xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="p-6">
                <div class="text-4xl font-extrabold text-blue-600 mb-1">{{ $stats['available_workers'] }}+</div>
                <div class="text-gray-600 font-medium">عاملة متاحة الآن</div>
            </div>
            <div class="p-6 border-x border-gray-100">
                <div class="text-4xl font-extrabold text-green-600 mb-1">{{ $stats['happy_clients'] }}+</div>
                <div class="text-gray-600 font-medium">عميل سعيد</div>
            </div>
            <div class="p-6">
                <div class="text-4xl font-extrabold text-purple-600 mb-1">{{ $stats['avg_arrival_days'] }}</div>
                <div class="text-gray-600 font-medium">يوم متوسط الوصول</div>
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
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden">
            <div class="bg-gray-200 h-48 flex items-center justify-center text-gray-400 text-6xl">
                @if($worker->photo)
                    <img src="{{ asset('storage/'.$worker->photo) }}" alt="{{ $worker->name }}" class="w-full h-full object-cover">
                @else
                    👩
                @endif
            </div>
            <div class="p-5">
                <h3 class="font-bold text-lg text-gray-800 mb-1">{{ $worker->name }}</h3>
                <div class="flex flex-wrap gap-2 text-sm text-gray-500 mb-3">
                    <span>🌍 {{ $worker->nationality }}</span>
                    <span>🎂 {{ $worker->age }} سنة</span>
                </div>
                @if($worker->expected_salary)
                    <p class="text-blue-600 font-bold mb-3">{{ number_format($worker->expected_salary) }} ريال/شهر</p>
                @endif
                <a href="{{ route('workers.show', $worker) }}"
                   class="block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                    عرض الملف
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="text-center mt-8">
        <a href="{{ route('workers.index') }}" class="bg-gray-800 text-white px-8 py-3 rounded-lg hover:bg-gray-900 transition font-medium">
            عرض جميع العمالة ←
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
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition">
                <div class="text-5xl mb-4">⚡</div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">سرعة الاستقدام</h3>
                <p class="text-gray-500">نضمن وصول العاملة في أقل من 30 يوم عمل مع متابعة مستمرة لكل خطوة</p>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition">
                <div class="text-5xl mb-4">🛡️</div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">ضمان العمالة</h3>
                <p class="text-gray-500">نقدم ضمان استبدال مجاني لمدة 3 أشهر في حال عدم التوافق مع العاملة</p>
            </div>
            <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-md transition">
                <div class="text-5xl mb-4">🎯</div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">اختيار دقيق</h3>
                <p class="text-gray-500">نختار العمالة بعناية فائقة بعد فحص شامل للمهارات والسيرة الذاتية</p>
            </div>
        </div>
    </div>
</section>

{{-- How It Works --}}
<section class="py-16 px-4 max-w-5xl mx-auto">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">خطوات العمل</h2>
        <p class="text-gray-500">عملية سهلة وشفافة من البداية للنهاية</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
            <h3 class="font-bold text-lg mb-2">اختر العاملة</h3>
            <p class="text-gray-500 text-sm">تصفح ملفات العمالة المتاحة واختر المناسبة لاحتياجاتك</p>
        </div>
        <div class="text-center">
            <div class="w-16 h-16 bg-green-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
            <h3 class="font-bold text-lg mb-2">وقّع العقد</h3>
            <p class="text-gray-500 text-sm">نوقع عقداً رسمياً يضمن حقوقك ويحدد جميع الشروط بوضوح</p>
        </div>
        <div class="text-center">
            <div class="w-16 h-16 bg-purple-600 text-white rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
            <h3 class="font-bold text-lg mb-2">استقبل العاملة</h3>
            <p class="text-gray-500 text-sm">نتولى جميع الإجراءات ونسلمك العاملة على باب منزلك</p>
        </div>
    </div>
</section>

{{-- Services Preview --}}
@if($services->count())
<section class="bg-gray-800 text-white py-16 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold mb-3">خدماتنا</h2>
            <p class="text-gray-400">مجموعة متكاملة من الخدمات لتلبية احتياجاتك</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($services as $service)
            <div class="bg-gray-700 rounded-xl p-6 text-center hover:bg-gray-600 transition">
                @if($service->icon)
                    <div class="text-4xl mb-3">{{ $service->icon }}</div>
                @endif
                <h3 class="font-bold text-lg mb-2">{{ $service->title }}</h3>
                @if($service->description)
                    <p class="text-gray-400 text-sm">{{ $service->description }}</p>
                @endif
                @if($service->price)
                    <p class="text-green-400 font-bold mt-3">{{ number_format($service->price) }} ريال</p>
                @endif
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('services') }}" class="bg-blue-500 text-white px-8 py-3 rounded-lg hover:bg-blue-600 transition">
                جميع الخدمات
            </a>
        </div>
    </div>
</section>
@endif

{{-- Testimonials --}}
@if($testimonials->count())
<section class="py-16 px-4 max-w-6xl mx-auto">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">آراء عملائنا</h2>
        <p class="text-gray-500">ما يقوله عملاؤنا عن تجربتهم معنا</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($testimonials as $testimonial)
        <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition">
            <div class="flex mb-3">
                @for($i = 0; $i < $testimonial->rating; $i++)
                    <span class="text-yellow-400 text-lg">★</span>
                @endfor
                @for($i = $testimonial->rating; $i < 5; $i++)
                    <span class="text-gray-200 text-lg">★</span>
                @endfor
            </div>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">"{{ $testimonial->content }}"</p>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                    {{ mb_substr($testimonial->client_name, 0, 1) }}
                </div>
                <span class="font-bold text-gray-700">{{ $testimonial->client_name }}</span>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- Partners --}}
@if($partners->count())
<section class="bg-gray-50 py-12 px-4">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">شركاؤنا</h2>
        <div class="flex flex-wrap justify-center gap-6">
            @foreach($partners as $partner)
            <div class="bg-white rounded-xl px-8 py-4 shadow-sm hover:shadow-md transition flex items-center gap-3">
                <span class="text-2xl">🤝</span>
                <div>
                    <div class="font-bold text-gray-700">{{ $partner->name }}</div>
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
