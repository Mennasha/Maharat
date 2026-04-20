@extends('layouts.admin')
@section('title', 'الشركاء')
@section('page-title', 'الشركاء')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">إجمالي: {{ $partners->total() }}</p>
    <a href="{{ route('admin.partners.create') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">+ إضافة شريك</a>
</div>
<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الشعار</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الاسم</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الدولة</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الحالة</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">إجراءات</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($partners as $p)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    @if($p->logo)
                        <img src="{{ asset('storage/'.$p->logo) }}" class="w-10 h-10 object-contain rounded">
                    @else
                        <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">لا صورة</div>
                    @endif
                </td>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $p->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $p->country ?? '-' }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ $p->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $p->is_active ? 'فعّال' : 'مخفي' }}</span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.partners.edit', $p) }}" class="text-blue-600 hover:underline text-xs">تعديل</a>
                        <form method="POST" action="{{ route('admin.partners.destroy', $p) }}" onsubmit="return confirm('هل أنت متأكد؟')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-xs">حذف</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-10 text-gray-400">لا يوجد شركاء بعد</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $partners->links() }}</div>
</div>
@endsection
