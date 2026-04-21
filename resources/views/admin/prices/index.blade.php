@extends('layouts.admin')
@section('title', 'أسعار الجنسيات')
@section('page-title', 'أسعار الجنسيات')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">إجمالي: {{ $prices->total() }}</p>
    <a href="{{ route('admin.prices.create') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">+ إضافة سعر</a>
</div>
<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الجنسية</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">السعر (ريال)</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">ملاحظات</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الحالة</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">إجراءات</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($prices as $p)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $p->nationality }}</td>
                <td class="px-4 py-3 text-blue-600 font-bold">{{ number_format($p->price) }}</td>
                <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ $p->notes ?? '-' }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ $p->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $p->is_active ? 'فعّال' : 'مخفي' }}</span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.prices.edit', $p) }}" class="text-blue-600 hover:underline text-xs">تعديل</a>
                        <form method="POST" action="{{ route('admin.prices.destroy', $p) }}" onsubmit="return confirm('هل أنت متأكد؟')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-xs">حذف</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-10 text-gray-400">لا توجد أسعار بعد</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $prices->links() }}</div>
</div>
@endsection
