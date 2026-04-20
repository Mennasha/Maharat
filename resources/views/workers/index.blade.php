@extends('layouts.app')

@section('title', 'استعراض العمالة')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">استعراض العمالة المتاحة</h1>

    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Filters Sidebar --}}
        <aside class="lg:w-72">
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="font-bold text-lg text-gray-800 mb-5 border-b pb-3">🔍 تصفية النتائج</h2>
                <form method="GET" action="{{ route('workers.index') }}" class="space-y-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">الجنسية</label>
                        <select name="nationality" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">الكل</option>
                            @foreach($nationalities as $nat)
                                <option value="{{ $nat }}" {{ request('nationality') == $nat ? 'selected' : '' }}>{{ $nat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">الديانة</label>
                        <select name="religion" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">الكل</option>
                            <option value="إسلامية" {{ request('religion') == 'إسلامية' ? 'selected' : '' }}>إسلامية</option>
                            <option value="مسيحية" {{ request('religion') == 'مسيحية' ? 'selected' : '' }}>مسيحية</option>
                            <option value="هندوسية" {{ request('religion') == 'هندوسية' ? 'selected' : '' }}>هندوسية</option>
                            <option value="بوذية" {{ request('religion') == 'بوذية' ? 'selected' : '' }}>بوذية</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">الحالة الاجتماعية</label>
                        <select name="marital_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">الكل</option>
                            <option value="عزباء" {{ request('marital_status') == 'عزباء' ? 'selected' : '' }}>عزباء</option>
                            <option value="متزوجة" {{ request('marital_status') == 'متزوجة' ? 'selected' : '' }}>متزوجة</option>
                            <option value="مطلقة" {{ request('marital_status') == 'مطلقة' ? 'selected' : '' }}>مطلقة</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">اللغة</label>
                        <select name="language" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">الكل</option>
                            <option value="العربية" {{ request('language') == 'العربية' ? 'selected' : '' }}>العربية</option>
                            <option value="الإنجليزية" {{ request('language') == 'الإنجليزية' ? 'selected' : '' }}>الإنجليزية</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">الراتب الأدنى (ريال)</label>
                        <input type="number" name="min_salary" value="{{ request('min_salary') }}"
                               placeholder="مثال: 800"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">الراتب الأقصى (ريال)</label>
                        <input type="number" name="max_salary" value="{{ request('max_salary') }}"
                               placeholder="مثال: 1500"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                        تطبيق الفلتر
                    </button>
                    <a href="{{ route('workers.index') }}" class="block text-center text-gray-500 hover:text-gray-700 text-sm mt-2">
                        إعادة تعيين
                    </a>
                </form>
            </div>
        </aside>

        {{-- Workers Grid --}}
        <div class="flex-1">
            <div class="flex justify-between items-center mb-5">
                <p class="text-gray-600 text-sm">
                    عدد النتائج: <span class="font-bold text-gray-800">{{ $workers->total() }}</span>
                </p>
            </div>

            @if($workers->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                @foreach($workers as $worker)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden">
                    <div class="bg-gradient-to-b from-gray-200 to-gray-300 h-48 flex items-center justify-center text-6xl">
                        @if($worker->photo)
                            <img src="{{ asset('storage/'.$worker->photo) }}" alt="{{ $worker->name }}" class="w-full h-full object-cover">
                        @else
                            👩
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-gray-800">{{ $worker->name }}</h3>
                            <span class="text-xs px-2 py-1 rounded-full
                                {{ $worker->status == 'available' ? 'bg-green-100 text-green-700' : ($worker->status == 'reserved' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                {{ $worker->status_label }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-1 text-xs text-gray-500 mb-3">
                            <span>🌍 {{ $worker->nationality }}</span>
                            <span>🎂 {{ $worker->age }} سنة</span>
                            @if($worker->religion)
                                <span>🕌 {{ $worker->religion }}</span>
                            @endif
                            @if($worker->language)
                                <span>💬 {{ $worker->language }}</span>
                            @endif
                        </div>
                        @if($worker->expected_salary)
                            <p class="text-blue-600 font-bold text-sm mb-3">{{ number_format($worker->expected_salary) }} ريال/شهر</p>
                        @endif
                        <a href="{{ route('workers.show', $worker) }}"
                           class="block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                            عرض الملف الكامل
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $workers->links() }}
            </div>
            @else
            <div class="bg-white rounded-2xl shadow p-16 text-center">
                <div class="text-6xl mb-4">😔</div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">لا توجد نتائج</h3>
                <p class="text-gray-500">جرب تغيير معايير البحث</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
