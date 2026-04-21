@extends('layouts.admin')
@section('title', 'الخدمات')
@section('page-title', 'الخدمات')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">إجمالي: {{ $services->total() }}</p>
    <a href="{{ route('admin.services.create') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">+ إضافة خدمة</a>
</div>
<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الأيقونة</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">العنوان</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">السعر</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الحالة</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">إجراءات</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($services as $s)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-2xl">{{ $s->icon }}</td>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $s->title }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $s->price ? number_format($s->price).' ريال' : '-' }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ $s->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $s->is_active ? 'فعّال' : 'مخفي' }}</span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.services.edit', $s) }}" class="text-blue-600 hover:underline text-xs">تعديل</a>
                        <form method="POST" action="{{ route('admin.services.destroy', $s) }}" onsubmit="return confirm('هل أنت متأكد؟')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-xs">حذف</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-10 text-gray-400">لا توجد خدمات بعد</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $services->links() }}</div>
</div>
@endsection
