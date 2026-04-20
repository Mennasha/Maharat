@extends('layouts.admin')

@section('title', 'إدارة الطلبات')
@section('page-title', 'إدارة الطلبات')

@section('content')
<div class="bg-white rounded-2xl shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">#</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">العميل</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">العاملة</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">الحالة</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">المبلغ الإجمالي</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">المدفوع</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">التاريخ</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-500">{{ $order->id }}</td>
                    <td class="px-4 py-3 font-bold text-gray-800">{{ $order->client->name ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $order->worker->name ?? '-' }}</td>
                    <td class="px-4 py-3">
                        @php
                            $statusColors = [
                                'contracted' => 'bg-blue-100 text-blue-700',
                                'visa_processing' => 'bg-yellow-100 text-yellow-700',
                                'training' => 'bg-orange-100 text-orange-700',
                                'ticket_booked' => 'bg-purple-100 text-purple-700',
                                'arrived' => 'bg-green-100 text-green-700',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ number_format($order->total_amount) }} ريال</td>
                    <td class="px-4 py-3 text-gray-600">{{ number_format($order->paid_amount) }} ريال</td>
                    <td class="px-4 py-3 text-gray-500 text-xs">{{ $order->created_at->format('Y/m/d') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="text-blue-600 hover:underline text-xs font-medium">عرض التفاصيل</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">لا توجد طلبات</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
