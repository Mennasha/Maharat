@extends('layouts.app')

@section('title', 'خدماتنا')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-3">خدماتنا</h1>
        <p class="text-gray-500 text-lg">نقدم مجموعة متكاملة من الخدمات لتلبية جميع احتياجاتك</p>
    </div>

    @if($services->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $service)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-8 text-center">
            @if($service->icon)
                <div class="text-5xl mb-4">{{ $service->icon }}</div>
            @endif
            <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $service->title }}</h3>
            @if($service->description)
                <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $service->description }}</p>
            @endif
            @if($service->price)
                <div class="bg-blue-50 rounded-xl px-4 py-3 inline-block">
                    <span class="text-2xl font-bold text-blue-600">{{ number_format($service->price) }}</span>
                    <span class="text-blue-500 text-sm mr-1">ريال</span>
                </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16">
        <p class="text-gray-500 text-lg">لا توجد خدمات متاحة حالياً</p>
    </div>
    @endif

    <div class="mt-16 bg-blue-600 rounded-2xl p-10 text-center text-white">
        <h2 class="text-3xl font-bold mb-3">هل تحتاج استشارة؟</h2>
        <p class="text-blue-100 mb-6">تواصل معنا الآن وسنساعدك في اختيار الخدمة المناسبة</p>
        <a href="https://wa.me/966500000000" target="_blank"
           class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition inline-block">
            💬 تواصل عبر واتساب
        </a>
    </div>
</div>
@endsection
