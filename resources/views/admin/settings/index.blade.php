@extends('layouts.admin')
@section('title', 'إعدادات الموقع')
@section('page-title', 'إعدادات الموقع')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow p-8">
        @if($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div><label class="block text-sm font-medium text-gray-700 mb-1">اسم الموقع / الشركة *</label>
                <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">رقم الهاتف</label>
                <input type="text" name="site_phone" value="{{ old('site_phone', $settings['site_phone']) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" dir="ltr" placeholder="+966 50 000 0000">
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">رقم واتساب (مع رمز الدولة)</label>
                <input type="text" name="site_whatsapp" value="{{ old('site_whatsapp', $settings['site_whatsapp']) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" dir="ltr" placeholder="966500000000">
                <p class="text-xs text-gray-400 mt-1">بدون + أو مسافات، مثال: 966501234567</p>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                <input type="email" name="site_email" value="{{ old('site_email', $settings['site_email']) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" dir="ltr">
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">العنوان</label>
                <input type="text" name="site_address" value="{{ old('site_address', $settings['site_address']) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">شعار الموقع</label>
                @if($settings['site_logo'])
                    <div class="mb-2 flex items-center gap-3">
                        <img src="{{ asset('storage/'.$settings['site_logo']) }}" class="h-12 object-contain border rounded">
                        <span class="text-xs text-gray-400">الشعار الحالي</span>
                    </div>
                @endif
                <input type="file" name="site_logo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <p class="text-xs text-gray-400 mt-1">يُفضّل PNG شفاف، حجم أقصى 2 ميغابايت</p>
            </div>
            <div class="pt-2">
                <button type="submit" class="bg-blue-600 text-white px-8 py-2.5 rounded-lg hover:bg-blue-700 transition font-medium">حفظ الإعدادات</button>
            </div>
        </form>
    </div>
</div>
@endsection
