@extends('layouts.app')

@section('title', $worker->name . ' - ملف العاملة')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="mb-6">
        <a href="{{ route('workers.index') }}" class="text-blue-600 hover:underline text-sm">← العودة إلى قائمة العمالة</a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="md:flex">
            {{-- Photo Section --}}
            <div class="md:w-80 bg-gradient-to-b from-blue-100 to-blue-200 flex items-center justify-center min-h-64 text-8xl p-8">
                @if($worker->photo)
                    <img src="{{ asset('storage/'.$worker->photo) }}" alt="{{ $worker->name }}" class="w-full rounded-xl object-cover">
                @else
                    👩
                @endif
            </div>

            {{-- Info Section --}}
            <div class="flex-1 p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-800 mb-2">{{ $worker->name }}</h1>
                        <span class="text-lg text-gray-500">{{ $worker->nationality }}</span>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-bold
                        {{ $worker->status == 'available' ? 'bg-green-100 text-green-700' : ($worker->status == 'reserved' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ $worker->status_label }}
                    </span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-xl p-3 text-center">
                        <div class="text-2xl mb-1">🎂</div>
                        <div class="text-xs text-gray-500">العمر</div>
                        <div class="font-bold text-gray-800">{{ $worker->age }} سنة</div>
                    </div>
                    @if($worker->religion)
                    <div class="bg-gray-50 rounded-xl p-3 text-center">
                        <div class="text-2xl mb-1">🕌</div>
                        <div class="text-xs text-gray-500">الديانة</div>
                        <div class="font-bold text-gray-800">{{ $worker->religion }}</div>
                    </div>
                    @endif
                    @if($worker->marital_status)
                    <div class="bg-gray-50 rounded-xl p-3 text-center">
                        <div class="text-2xl mb-1">💍</div>
                        <div class="text-xs text-gray-500">الحالة الاجتماعية</div>
                        <div class="font-bold text-gray-800">{{ $worker->marital_status }}</div>
                    </div>
                    @endif
                    @if($worker->language)
                    <div class="bg-gray-50 rounded-xl p-3 text-center">
                        <div class="text-2xl mb-1">💬</div>
                        <div class="text-xs text-gray-500">اللغة</div>
                        <div class="font-bold text-gray-800">{{ $worker->language }}</div>
                    </div>
                    @endif
                    @if($worker->height)
                    <div class="bg-gray-50 rounded-xl p-3 text-center">
                        <div class="text-2xl mb-1">📏</div>
                        <div class="text-xs text-gray-500">الطول</div>
                        <div class="font-bold text-gray-800">{{ $worker->height }} سم</div>
                    </div>
                    @endif
                    @if($worker->weight)
                    <div class="bg-gray-50 rounded-xl p-3 text-center">
                        <div class="text-2xl mb-1">⚖️</div>
                        <div class="text-xs text-gray-500">الوزن</div>
                        <div class="font-bold text-gray-800">{{ $worker->weight }} كغ</div>
                    </div>
                    @endif
                    <div class="bg-gray-50 rounded-xl p-3 text-center">
                        <div class="text-2xl mb-1">💼</div>
                        <div class="text-xs text-gray-500">الخبرة</div>
                        <div class="font-bold text-gray-800">{{ $worker->experience_years }} سنوات</div>
                    </div>
                    @if($worker->expected_salary)
                    <div class="bg-blue-50 rounded-xl p-3 text-center">
                        <div class="text-2xl mb-1">💰</div>
                        <div class="text-xs text-gray-500">الراتب المتوقع</div>
                        <div class="font-bold text-blue-600">{{ number_format($worker->expected_salary) }} ريال</div>
                    </div>
                    @endif
                </div>

                {{-- Skills --}}
                @if($worker->skills && count($worker->skills))
                <div class="mb-5">
                    <h3 class="font-bold text-gray-700 mb-2">المهارات</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($worker->skills as $skill)
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Previous Countries --}}
                @if($worker->previous_countries && count($worker->previous_countries))
                <div class="mb-5">
                    <h3 class="font-bold text-gray-700 mb-2">دول العمل السابقة</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($worker->previous_countries as $country)
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">🌍 {{ $country }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                    @auth
                        @if($worker->status == 'available')
                        <div class="flex flex-wrap gap-3 mt-6">
                            <a href="{{ route('client.orders.create', ['worker_id' => $worker->id]) }}"
                               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-bold">
                                📋 احجز الآن
                            </a>
                            <a href="https://wa.me/{{ \App\Models\Setting::get('site_whatsapp','966500000000') }}?text=أريد الاستفسار عن العاملة: {{ urlencode($worker->name) }}"
                               target="_blank"
                               class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition font-bold">
                                💬 تواصل عبر واتساب
                            </a>
                        </div>
                        @else
                        <div class="mt-6 bg-gray-100 text-gray-500 px-6 py-3 rounded-lg text-center font-medium">
                            هذه العاملة غير متاحة حالياً
                        </div>
                        @endif
                    @else
                        @if($worker->status == 'available')
                        <div class="flex flex-wrap gap-3 mt-6">
                            <a href="{{ route('login') }}"
                               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-bold">
                                📋 سجّل دخولك للحجز
                            </a>
                            <a href="https://wa.me/{{ \App\Models\Setting::get('site_whatsapp','966500000000') }}?text=أريد الاستفسار عن العاملة: {{ urlencode($worker->name) }}"
                               target="_blank"
                               class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition font-bold">
                                💬 تواصل عبر واتساب
                            </a>
                        </div>
                        @else
                        <div class="mt-6 bg-gray-100 text-gray-500 px-6 py-3 rounded-lg text-center font-medium">
                            هذه العاملة غير متاحة حالياً
                        </div>
                        @endif
                    @endauth
            </div>
        </div>

        {{-- Notes --}}
        @if($worker->notes)
        <div class="p-8 border-t border-gray-100">
            <h3 class="font-bold text-gray-700 mb-3">ملاحظات إضافية</h3>
            <p class="text-gray-600 leading-relaxed">{{ $worker->notes }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
