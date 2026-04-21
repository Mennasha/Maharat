@extends('layouts.admin')

@section('title', 'إدارة العمالة')
@section('page-title', 'إدارة العمالة')

@section('content')
<div class="flex flex-wrap justify-between items-center mb-6 gap-3">
    <div class="flex items-center gap-3 flex-1 min-w-0">
        <form method="GET" action="{{ route('admin.workers.index') }}" class="flex gap-2 flex-1 max-w-md">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="بحث بالاسم أو الجنسية..."
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-900 transition">بحث</button>
            @if(request('search'))
            <a href="{{ route('admin.workers.index') }}" class="border border-gray-300 px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-gray-100 transition">مسح</a>
            @endif
        </form>
        <p class="text-gray-500 text-sm whitespace-nowrap">{{ $workers->total() }} عاملة</p>
    </div>
    <a href="{{ route('admin.workers.create') }}"
       class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition font-medium flex items-center gap-2 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        إضافة عاملة
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">#</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">الاسم</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">الجنسية</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">العمر</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">الراتب</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">الحالة</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">مميزة</th>
                    <th class="px-4 py-3 text-right text-gray-600 font-medium">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($workers as $worker)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-500">{{ $worker->id }}</td>
                    <td class="px-4 py-3 font-bold text-gray-800">{{ $worker->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $worker->nationality }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $worker->age }}</td>
                    <td class="px-4 py-3 text-gray-600">
                        {{ $worker->expected_salary ? number_format($worker->expected_salary) . ' ريال' : '-' }}
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            {{ $worker->status == 'available' ? 'bg-green-100 text-green-700' :
                               ($worker->status == 'reserved' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                            {{ $worker->status_label }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($worker->is_featured)
                            <span class="text-yellow-500">⭐</span>
                        @else
                            <span class="text-gray-300">⭐</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.workers.edit', $worker) }}"
                               class="text-blue-600 hover:underline text-xs font-medium">تعديل</a>
                            <form method="POST" action="{{ route('admin.workers.destroy', $worker) }}"
                                  onsubmit="return confirm('هل تريد حذف هذه العاملة؟')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs font-medium">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">لا توجد بيانات</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $workers->links() }}
    </div>
</div>
@endsection
