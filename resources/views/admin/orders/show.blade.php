@extends('layouts.admin')

@section('title', 'تفاصيل الطلب #' . $order->id)
@section('page-title', 'تفاصيل الطلب #' . $order->id)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Order Details --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-5">معلومات الطلب</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-500 mb-1">العميل</p>
                    <p class="font-bold text-gray-800">{{ $order->client->name ?? '-' }}</p>
                    @if($order->client->phone)
                        <p class="text-sm text-gray-500">{{ $order->client->phone }}</p>
                    @endif
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">العاملة</p>
                    <p class="font-bold text-gray-800">{{ $order->worker->name ?? '-' }}</p>
                    @if($order->worker)
                        <p class="text-sm text-gray-500">{{ $order->worker->nationality }}</p>
                    @endif
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">المبلغ الإجمالي</p>
                    <p class="font-bold text-gray-800">{{ number_format($order->total_amount) }} ريال</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">المبلغ المدفوع</p>
                    <p class="font-bold text-green-600">{{ number_format($order->paid_amount) }} ريال</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">المتبقي</p>
                    <p class="font-bold text-red-600">{{ number_format($order->total_amount - $order->paid_amount) }} ريال</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">تاريخ الطلب</p>
                    <p class="font-bold text-gray-800">{{ $order->created_at->format('Y/m/d') }}</p>
                </div>
            </div>
            @if($order->notes)
            <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                <p class="text-xs text-gray-500 mb-1">ملاحظات</p>
                <p class="text-sm text-gray-700">{{ $order->notes }}</p>
            </div>
            @endif
        </div>

        {{-- Timeline --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-5">سجل الحالات</h2>
            @if($order->timeline->count())
            <div class="space-y-4">
                @foreach($order->timeline as $entry)
                <div class="flex gap-4">
                    <div class="w-3 h-3 bg-blue-500 rounded-full mt-1.5 flex-shrink-0"></div>
                    <div>
                        <p class="font-medium text-gray-800 text-sm">
                            @php
                                $labels = ['contracted'=>'تم التعاقد','visa_processing'=>'قيد استخراج التأشيرة','training'=>'قيد التدريب','ticket_booked'=>'تم حجز التذكرة','arrived'=>'وصل'];
                            @endphp
                            {{ $labels[$entry->status] ?? $entry->status }}
                        </p>
                        @if($entry->description)
                            <p class="text-sm text-gray-500">{{ $entry->description }}</p>
                        @endif
                        <p class="text-xs text-gray-400 mt-1">{{ $entry->created_at->format('Y/m/d H:i') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-sm">لا توجد تحديثات بعد</p>
            @endif
        </div>
    </div>

    {{-- Update Status --}}
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">الحالة الحالية</h2>
            @php
                $statusColors = ['contracted'=>'bg-blue-100 text-blue-700','visa_processing'=>'bg-yellow-100 text-yellow-700','training'=>'bg-orange-100 text-orange-700','ticket_booked'=>'bg-purple-100 text-purple-700','arrived'=>'bg-green-100 text-green-700'];
            @endphp
            <span class="px-4 py-2 rounded-full text-sm font-bold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                {{ $order->status_label }}
            </span>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">تحديث الحالة</h2>
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الحالة الجديدة</label>
                    <select name="status" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="contracted" {{ $order->status == 'contracted' ? 'selected' : '' }}>تم التعاقد</option>
                        <option value="visa_processing" {{ $order->status == 'visa_processing' ? 'selected' : '' }}>قيد استخراج التأشيرة</option>
                        <option value="training" {{ $order->status == 'training' ? 'selected' : '' }}>قيد التدريب</option>
                        <option value="ticket_booked" {{ $order->status == 'ticket_booked' ? 'selected' : '' }}>تم حجز التذكرة</option>
                        <option value="arrived" {{ $order->status == 'arrived' ? 'selected' : '' }}>وصل</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">وصف التحديث</label>
                    <textarea name="description" rows="3" placeholder="اكتب ملاحظة عن هذا التحديث..."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-bold">
                    تحديث الحالة
                </button>
            </form>
        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="block text-center text-gray-500 hover:text-gray-700 text-sm">← العودة للطلبات</a>
    </div>

</div>
@endsection
