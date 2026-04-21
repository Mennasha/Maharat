@extends('layouts.app')
@section('title', 'تواصل معنا')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-3">تواصل معنا</h1>
        <p class="text-gray-500 text-lg">يسعدنا الإجابة على استفساراتك في أقرب وقت ممكن</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Contact info --}}
        <div class="space-y-5">
            @php
                $phone = \App\Models\Setting::get('site_phone','');
                $whatsapp = \App\Models\Setting::get('site_whatsapp','');
                $email = \App\Models\Setting::get('site_email','');
                $address = \App\Models\Setting::get('site_address','المملكة العربية السعودية');
            @endphp
            <div class="bg-white rounded-2xl shadow p-5 flex items-start gap-4">
                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-800 mb-1">الهاتف</p>
                    <p class="text-gray-600 text-sm" dir="ltr">{{ $phone ?: '+966 50 000 0000' }}</p>
                </div>
            </div>
            @if($whatsapp)
            <div class="bg-white rounded-2xl shadow p-5 flex items-start gap-4">
                <div class="w-10 h-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shrink-0 text-lg">💬</div>
                <div>
                    <p class="font-bold text-gray-800 mb-1">واتساب</p>
                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="text-green-600 text-sm hover:underline" dir="ltr">+{{ $whatsapp }}</a>
                </div>
            </div>
            @endif
            @if($email)
            <div class="bg-white rounded-2xl shadow p-5 flex items-start gap-4">
                <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-800 mb-1">البريد الإلكتروني</p>
                    <a href="mailto:{{ $email }}" class="text-gray-600 text-sm hover:text-blue-600" dir="ltr">{{ $email }}</a>
                </div>
            </div>
            @endif
            <div class="bg-white rounded-2xl shadow p-5 flex items-start gap-4">
                <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-800 mb-1">العنوان</p>
                    <p class="text-gray-600 text-sm">{{ $address }}</p>
                </div>
            </div>
        </div>

        {{-- Contact form --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow p-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                    <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif
            <h2 class="text-xl font-bold text-gray-800 mb-6">أرسل لنا رسالة</h2>
            <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">الاسم *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">رقم الجوال</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500" dir="ltr">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500" dir="ltr">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الموضوع</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" placeholder="مثال: استفسار عن عاملة منزلية" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الرسالة *</label>
                    <textarea name="message" rows="5" required class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-bold">
                    إرسال الرسالة
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
