@extends('layouts.app')

@section('title', 'حسابي')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">مرحباً، {{ auth()->user()->name }} 👋</h1>
        <p class="text-gray-500 mt-1">هذه لوحة تحكم حسابك الشخصي</p>
    </div>

    @if($client)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs text-gray-500 mb-1">إجمالي الطلبات</p>
            <p class="text-3xl font-bold text-blue-600">{{ $orders->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs text-gray-500 mb-1">قيد التنفيذ</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $orders->whereNotIn('status', ['arrived'])->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-5">
            <p class="text-xs text-gray-500 mb-1">مكتملة</p>
            <p class="text-3xl font-bold text-green-600">{{ $orders->where('status', 'arrived')->count() }}</p>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-5">طلباتي</h2>

        @if($orders->count())
        <div class="space-y-4">
            @foreach($orders as $order)
            <div class="border border-gray-200 rounded-xl p-5 hover:border-blue-300 transition">
                <div class="flex flex-wrap justify-between items-start gap-3">
                    <div>
                        <h3 class="font-bold text-gray-800 mb-1">
                            طلب #{{ $order->id }} -
                            {{ $order->worker ? $order->worker->name : 'عاملة غير محددة' }}
                        </h3>
                        @if($order->worker)
                        <p class="text-sm text-gray-500">{{ $order->worker->nationality }}</p>
                        @endif
                    </div>
                    @php
                        $statusColors = ['contracted'=>'bg-blue-100 text-blue-700','visa_processing'=>'bg-yellow-100 text-yellow-700','training'=>'bg-orange-100 text-orange-700','ticket_booked'=>'bg-purple-100 text-purple-700','arrived'=>'bg-green-100 text-green-700'];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-bold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ $order->status_label }}
                    </span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-4 text-sm">
                    <div>
                        <span class="text-gray-500">المبلغ الإجمالي:</span>
                        <span class="font-bold mr-1">{{ number_format($order->total_amount) }} ريال</span>
                    </div>
                    <div>
                        <span class="text-gray-500">المدفوع:</span>
                        <span class="font-bold text-green-600 mr-1">{{ number_format($order->paid_amount) }} ريال</span>
                    </div>
                    <div>
                        <span class="text-gray-500">تاريخ الطلب:</span>
                        <span class="font-bold mr-1">{{ $order->created_at->format('Y/m/d') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="text-6xl mb-4">📋</div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">لا توجد طلبات</h3>
            <p class="text-gray-500 mb-6">ابدأ باستعراض العمالة المتاحة</p>
            <a href="{{ route('workers.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium">
                استعراض العمالة
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
