@extends('layouts.admin')
@section('title', 'رسائل التواصل')
@section('page-title', 'رسائل التواصل')

@section('content')
<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الاسم</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الهاتف</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الموضوع</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الرسالة</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">التاريخ</th>
                <th class="px-4 py-3 text-start text-gray-600 font-medium">الحالة</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($requests as $r)
            <tr class="hover:bg-gray-50 {{ !$r->is_read ? 'bg-blue-50' : '' }}">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $r->name }}</td>
                <td class="px-4 py-3 text-gray-600" dir="ltr">{{ $r->phone ?? '-' }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $r->subject ?? '-' }}</td>
                <td class="px-4 py-3 text-gray-600 max-w-xs">
                    <p class="truncate">{{ $r->message }}</p>
                </td>
                <td class="px-4 py-3 text-gray-500 text-xs whitespace-nowrap">{{ $r->created_at->format('Y/m/d H:i') }}</td>
                <td class="px-4 py-3">
                    @if(!$r->is_read)
                        <form method="POST" action="{{ route('admin.contact-requests.read', $r) }}">
                            @csrf
                            <button type="submit" class="text-xs bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition">تحديد كمقروء</button>
                        </form>
                    @else
                        <span class="text-xs text-gray-400">مقروء</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-10 text-gray-400">لا توجد رسائل بعد</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $requests->links() }}</div>
</div>
@endsection
