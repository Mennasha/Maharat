@extends('layouts.admin')
@section('title', 'التقييمات')
@section('page-title', 'التقييمات')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">إجمالي: {{ $testimonials->total() }}</p>
    <a href="{{ route('admin.testimonials.create') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">+ إضافة تقييم</a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">العميل</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">التقييم</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">المحتوى</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الحالة</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">إجراءات</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($testimonials as $t)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $t->client_name }}</td>
                <td class="px-4 py-3 text-yellow-500">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</td>
                <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $t->content }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ $t->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $t->is_active ? 'فعّال' : 'مخفي' }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="text-blue-600 hover:underline text-xs">تعديل</a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-xs">حذف</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-10 text-gray-400">لا توجد تقييمات بعد</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $testimonials->links() }}</div>
</div>
@endsection
