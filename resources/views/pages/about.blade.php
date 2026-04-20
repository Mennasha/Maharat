@extends('layouts.app')
@section('title', 'من نحن')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    {{-- Hero --}}
    <div class="text-center mb-14">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">من نحن</h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto">وكالة مهارات للاستقدام — شريكك الموثوق في استقدام العمالة المنزلية المدربة</p>
    </div>

    {{-- Story --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">قصتنا</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                نحن وكالة متخصصة في استقدام العمالة المنزلية المدربة والمؤهلة من أفضل الدول الآسيوية والأفريقية. نؤمن بأن راحة الأسرة تبدأ من اختيار العاملة المناسبة.
            </p>
            <p class="text-gray-600 leading-relaxed">
                نوفر خدمة متكاملة تبدأ من اختيار العاملة وتنتهي بوصولها إلى منزلك، مع متابعة مستمرة وضمان على جودة الخدمة.
            </p>
        </div>
        <div class="bg-gradient-to-br from-blue-100 to-green-100 rounded-2xl p-10 text-center">
            <div class="text-7xl mb-4">🏠</div>
            <p class="text-2xl font-bold text-blue-700">{{ \App\Models\Setting::get('site_name', 'مهارات للاستقدام') }}</p>
            <p class="text-gray-500 mt-2">منذ تأسيسنا ونحن نخدم الأسر السعودية</p>
        </div>
    </div>

    {{-- Values --}}
    <div class="mb-16">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">قيمنا</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <div class="text-4xl mb-3">🤝</div>
                <h3 class="font-bold text-gray-800 mb-2">الأمانة والمصداقية</h3>
                <p class="text-gray-500 text-sm">نلتزم بالشفافية الكاملة في جميع تعاملاتنا مع عملائنا</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <div class="text-4xl mb-3">⭐</div>
                <h3 class="font-bold text-gray-800 mb-2">الجودة والتميز</h3>
                <p class="text-gray-500 text-sm">نختار أفضل العمالة المدربة والمؤهلة لضمان رضاء العملاء</p>
            </div>
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                <div class="text-4xl mb-3">⚡</div>
                <h3 class="font-bold text-gray-800 mb-2">السرعة والكفاءة</h3>
                <p class="text-gray-500 text-sm">نحرص على إتمام إجراءات الاستقدام في أسرع وقت ممكن</p>
            </div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="bg-gradient-to-l from-blue-700 to-green-600 rounded-2xl p-10 text-center text-white">
        <h2 class="text-2xl font-bold mb-3">هل أنت مستعد لتوفير العاملة المثالية؟</h2>
        <p class="text-blue-100 mb-6">تصفح قائمة العمالة المتاحة وابدأ رحلتك معنا اليوم</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('workers.index') }}" class="bg-white text-blue-700 px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition">
                استعراض العمالة
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-700 transition">
                تواصل معنا
            </a>
        </div>
    </div>
</div>
@endsection
