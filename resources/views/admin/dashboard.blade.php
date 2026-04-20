@extends('layouts.admin')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم الرئيسية')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-3xl">👥</span>
            <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">العمالة</span>
        </div>
        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ $stats['total_workers'] }}</div>
        <div class="text-sm text-gray-500">إجمالي العمالة</div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-3xl">✅</span>
            <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">متاح</span>
        </div>
        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ $stats['available_workers'] }}</div>
        <div class="text-sm text-gray-500">عمالة متاحة</div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-3xl">📋</span>
            <span class="text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded-full">الطلبات</span>
        </div>
        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ $stats['total_orders'] }}</div>
        <div class="text-sm text-gray-500">إجمالي الطلبات</div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="text-3xl">🤝</span>
            <span class="text-xs bg-orange-100 text-orange-600 px-2 py-1 rounded-full">العملاء</span>
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
