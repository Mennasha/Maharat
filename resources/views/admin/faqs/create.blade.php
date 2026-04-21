@extends('layouts.admin')
@section('title', 'إضافة سؤال')
@section('page-title', 'إضافة سؤال شائع')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl shadow p-8">
        @if($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm">
                <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.faqs.store') }}" class="space-y-5">
            @csrf
            <div><label class="block text-sm font-medium text-gray-700 mb-1">السؤال *</label>
                <textarea name="question" rows="2" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('question') }}</textarea>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">الإجابة *</label>
                <textarea name="answer" rows="4" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('answer') }}</textarea>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">الترتيب</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0" class="w-32 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-blue-600 rounded">
                <label for="is_active" class="text-sm text-gray-700">فعّال</label>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition font-medium">حفظ</button>
                <a href="{{ route('admin.faqs.index') }}" class="bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-300 transition">إلغاء</a>
            </div>
        </form>
    </div>
</div>
@endsection
