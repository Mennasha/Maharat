@extends('layouts.app')
@section('title', 'إنشاء طلب جديد')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="mb-6">
        <a href="{{ route('client.dashboard') }}" class="text-blue-600 hover:underline text-sm">← العودة إلى حسابي</a>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 mb-6">إنشاء طلب استقدام جديد</h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
            <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow p-8">
        <form method="POST" action="{{ route('client.orders.store') }}" class="space-y-6">
            @csrf

            {{-- Worker selection --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">اختر العاملة *</label>
                @if($worker)
                    {{-- Preselected from profile page --}}
                    <input type="hidden" name="worker_id" value="{{ $worker->id }}">
                    <div class="flex items-center gap-4 bg-blue-50 border border-blue-200 rounded-xl p-4">
                        @if($worker->photo)
                            <img src="{{ asset('storage/'.$worker->photo) }}" class="w-16 h-16 rounded-lg object-cover">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-3xl">👩</div>
                        @endif
                        <div>
                            <p class="font-bold text-gray-800 text-lg">{{ $worker->name }}</p>
                            <p class="text-sm text-gray-500">{{ $worker->nationality }} · {{ $worker->age }} سنة</p>
                            @if($worker->expected_salary)
                                <p class="text-blue-600 font-medium text-sm">{{ number_format($worker->expected_salary) }} ريال/شهر</p>
                            @endif
                        </div>
                        <a href="{{ route('client.orders.create') }}" class="ms-auto text-xs text-gray-500 hover:text-blue-600 underline">تغيير</a>
                    </div>
                @else
                    <select name="worker_id" required class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- اختر عاملة متاحة --</option>
                        @foreach($availableWorkers as $w)
                            <option value="{{ $w->id }}" {{ old('worker_id') == $w->id ? 'selected' : '' }}>
                                {{ $w->name }} — {{ $w->nationality }}{{ $w->expected_salary ? ' — '.number_format($w->expected_salary).' ريال/شهر' : '' }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>

            {{-- Notes --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">ملاحظات إضافية (اختياري)</label>
                <textarea name="notes" rows="4" placeholder="أي متطلبات خاصة أو تفاصيل تريد إضافتها..."
                          class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">{{ old('notes') }}</textarea>
            </div>

            {{-- Info box --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm text-yellow-800">
                <p class="font-semibold mb-1">ملاحظة مهمة:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li>سيتواصل معك فريقنا خلال 24 ساعة لتأكيد الطلب</li>
                    <li>إرسال الطلب لا يعني الحجز النهائي حتى يتم التأكيد</li>
                    <li>يمكنك متابعة حالة طلبك من لوحة حسابك</li>
                </ul>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition font-bold text-base">
                إرسال الطلب
            </button>
        </form>
    </div>
</div>
@endsection
