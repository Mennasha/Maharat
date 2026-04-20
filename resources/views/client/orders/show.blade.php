@extends('layouts.app')
@section('title', 'تفاصيل الطلب #' . $order->id)

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="mb-6">
        <a href="{{ route('client.dashboard') }}" class="text-blue-600 hover:underline text-sm">← العودة إلى حسابي</a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-l from-blue-700 to-blue-600 text-white p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold mb-1">طلب #{{ $order->id }}</h1>
                    <p class="text-blue-100 text-sm">تاريخ الطلب: {{ $order->created_at->format('Y/m/d') }}</p>
                </div>
                @php
                    $statusColors = ['contracted'=>'bg-blue-200 text-blue-900','visa_processing'=>'bg-yellow-200 text-yellow-900','training'=>'bg-orange-200 text-orange-900','ticket_booked'=>'bg-purple-200 text-purple-900','arrived'=>'bg-green-200 text-green-900'];
                @endphp
                <span class="px-4 py-2 rounded-full text-sm font-bold {{ $statusColors[$order->status] ?? 'bg-gray-200 text-gray-800' }}">
                    {{ $order->status_label }}
                </span>
            </div>
        </div>

        <div class="p-6 space-y-6">
            {{-- Worker info --}}
            @if($order->worker)
            <div class="flex items-center gap-4 bg-gray-50 rounded-xl p-4">
                @if($order->worker->photo)
                    <img src="{{ asset('storage/'.$order->worker->photo) }}" class="w-16 h-16 rounded-lg object-cover">
                @else
                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-3xl">👩</div>
                @endif
                <div>
                    <p class="font-bold text-gray-800 text-lg">{{ $order->worker->name }}</p>
                    <p class="text-sm text-gray-500">{{ $order->worker->nationality }} · {{ $order->worker->age }} سنة</p>
                    @if($order->worker->expected_salary)
                        <p class="text-blue-600 font-medium text-sm">{{ number_format($order->worker->expected_salary) }} ريال/شهر</p>
                    @endif
                </div>
                <a href="{{ route('workers.show', $order->worker) }}" class="ms-auto text-xs text-blue-600 hover:underline">عرض الملف</a>
            </div>
            @endif

            {{-- Financials --}}
            @if($order->total_amount)
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 rounded-xl p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">المبلغ الإجمالي</p>
                    <p class="text-xl font-bold text-gray-800">{{ number_format($order->total_amount) }} <span class="text-sm font-normal">ريال</span></p>
                </div>
                <div class="bg-green-50 rounded-xl p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">المدفوع</p>
                    <p class="text-xl font-bold text-green-600">{{ number_format($order->paid_amount) }} <span class="text-sm font-normal">ريال</span></p>
                </div>
            </div>
            @endif

            {{-- Timeline --}}
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-4">تتبع حالة الطلب</h2>
                @php
                    $steps = [
                        'contracted'      => 'تم التعاقد',
                        'visa_processing' => 'استخراج التأشيرة',
                        'training'        => 'قيد التدريب',
                        'ticket_booked'   => 'حجز التذكرة',
                        'arrived'         => 'وصول العاملة',
                    ];
                    $statusKeys = array_keys($steps);
                    $currentIdx = array_search($order->status, $statusKeys);
                @endphp
                <div class="relative">
                    @foreach($steps as $key => $label)
                    @php $idx = array_search($key, $statusKeys); $done = $idx <= $currentIdx; @endphp
                    <div class="flex items-start gap-4 pb-6 last:pb-0">
                        <div class="flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0
                                {{ $done ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                                @if($done)
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                @else
                                    <span class="text-xs font-bold">{{ $idx + 1 }}</span>
                                @endif
                            </div>
                            @if(!$loop->last)
                                <div class="w-0.5 h-full mt-1 {{ $idx < $currentIdx ? 'bg-blue-600' : 'bg-gray-200' }} flex-1 min-h-6"></div>
                            @endif
                        </div>
                        <div class="pt-1">
                            <p class="font-semibold {{ $done ? 'text-gray-800' : 'text-gray-400' }}">{{ $label }}</p>
                            @foreach($order->timeline->where('status', $key) as $tl)
                                <p class="text-xs text-gray-500 mt-0.5">{{ $tl->created_at->format('Y/m/d') }}{{ $tl->description ? ' — '.$tl->description : '' }}</p>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Notes --}}
            @if($order->notes)
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-sm font-semibold text-gray-700 mb-1">ملاحظاتك:</p>
                <p class="text-sm text-gray-600">{{ $order->notes }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
