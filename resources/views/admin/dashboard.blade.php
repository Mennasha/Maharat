@extends('layouts.admin')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم الرئيسية')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="flex items-center gap-1 text-xs text-green-600 font-medium bg-green-50 px-2 py-1 rounded-full">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                {{ $stats['workers_this_month'] ?? '+' }}
            </span>
        </div>
        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ $stats['total_workers'] }}</div>
        <div class="text-sm text-gray-500">إجمالي العمالة</div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full font-medium">متاح</span>
        </div>
        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ $stats['available_workers'] }}</div>
        <div class="text-sm text-gray-500">عمالة متاحة</div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <span class="flex items-center gap-1 text-xs text-green-600 font-medium bg-green-50 px-2 py-1 rounded-full">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                {{ $stats['orders_this_month'] ?? '+' }}
            </span>
        </div>
        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ $stats['total_orders'] }}</div>
        <div class="text-sm text-gray-500">إجمالي الطلبات</div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 hover:shadow-md transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <span class="flex items-center gap-1 text-xs text-green-600 font-medium bg-green-50 px-2 py-1 rounded-full">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                {{ $stats['clients_this_month'] ?? '+' }}
            </span>
        </div>
        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ $stats['total_clients'] }}</div>
        <div class="text-sm text-gray-500">إجمالي العملاء</div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <a href="{{ route('admin.workers.create') }}" class="bg-blue-600 text-white rounded-xl p-4 flex items-center gap-3 hover:bg-blue-700 transition">
        <span class="text-2xl">➕</span>
        <span class="font-bold">إضافة عاملة جديدة</span>
    </a>
    <a href="{{ route('admin.workers.index') }}" class="bg-green-600 text-white rounded-xl p-4 flex items-center gap-3 hover:bg-green-700 transition">
        <span class="text-2xl">👥</span>
        <span class="font-bold">إدارة العمالة</span>
    </a>
    <a href="{{ route('admin.orders.index') }}" class="bg-purple-600 text-white rounded-xl p-4 flex items-center gap-3 hover:bg-purple-700 transition">
        <span class="text-2xl">📋</span>
        <span class="font-bold">إدارة الطلبات</span>
    </a>
</div>

{{-- Recent Orders --}}
<div class="bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-5">آخر الطلبات</h2>
    @if($recentOrders->count())
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="pb-3 text-right text-gray-600 font-medium">#</th>
                    <th class="pb-3 text-right text-gray-600 font-medium">العميل</th>
                    <th class="pb-3 text-right text-gray-600 font-medium">العاملة</th>
                    <th class="pb-3 text-right text-gray-600 font-medium">الحالة</th>
                    <th class="pb-3 text-right text-gray-600 font-medium">التاريخ</th>
                    <th class="pb-3 text-right text-gray-600 font-medium">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($recentOrders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 text-gray-500">{{ $order->id }}</td>
                    <td class="py-3 font-medium text-gray-800">{{ $order->client->name ?? '-' }}</td>
                    <td class="py-3 text-gray-600">{{ $order->worker->name ?? '-' }}</td>
                    <td class="py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            {{ $order->status == 'arrived' ? 'bg-green-100 text-green-700' :
                               ($order->status == 'contracted' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td class="py-3 text-gray-500 text-xs">{{ $order->created_at->format('Y/m/d') }}</td>
                    <td class="py-3">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline text-xs">عرض</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-gray-500 text-center py-8">لا توجد طلبات بعد</p>
    @endif
</div>

@endsection
