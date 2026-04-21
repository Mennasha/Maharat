@extends('layouts.admin')

@section('title', 'إضافة عاملة جديدة')
@section('page-title', 'إضافة عاملة جديدة')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl shadow p-8">
        @if($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.workers.store') }}" class="space-y-5" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الاسم الكامل *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الجنسية *</label>
                    <input type="text" name="nationality" value="{{ old('nationality') }}" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">العمر *</label>
                    <input type="number" name="age" value="{{ old('age') }}" min="18" max="60" required
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الديانة</label>
                    <input type="text" name="religion" value="{{ old('religion') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الحالة الاجتماعية</label>
                    <select name="marital_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">اختر...</option>
                        <option value="عزباء" {{ old('marital_status') == 'عزباء' ? 'selected' : '' }}>عزباء</option>
                        <option value="متزوجة" {{ old('marital_status') == 'متزوجة' ? 'selected' : '' }}>متزوجة</option>
                        <option value="مطلقة" {{ old('marital_status') == 'مطلقة' ? 'selected' : '' }}>مطلقة</option>
                        <option value="أرملة" {{ old('marital_status') == 'أرملة' ? 'selected' : '' }}>أرملة</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">اللغات</label>
                    <input type="text" name="language" value="{{ old('language') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الطول (سم)</label>
                    <input type="number" name="height" value="{{ old('height') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الوزن (كغ)</label>
                    <input type="number" name="weight" value="{{ old('weight') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">سنوات الخبرة</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', 0) }}" min="0"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الراتب المتوقع (ريال)</label>
                    <input type="number" name="expected_salary" value="{{ old('expected_salary') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الحالة *</label>
                    <select name="status" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>متاحة</option>
                        <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>محجوزة</option>
                        <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>غير متاحة</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">صورة العاملة</label>
                <input type="file" name="photo" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                <p class="text-xs text-gray-400 mt-1">JPEG / PNG - حجم أقصى 2 ميغابايت</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">المهارات (مفصولة بفاصلة)</label>
                <input type="text" name="skills" value="{{ old('skills') }}" placeholder="مثال: طبخ, تنظيف, رعاية أطفال"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">دول العمل السابقة (مفصولة بفاصلة)</label>
                <input type="text" name="previous_countries" value="{{ old('previous_countries') }}" placeholder="مثال: السعودية, الكويت"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ملاحظات</label>
                <textarea name="notes" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('notes') }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                       {{ old('is_featured') ? 'checked' : '' }}
                       class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                <label for="is_featured" class="text-sm font-medium text-gray-700">عاملة مميزة (تظهر في الصفحة الرئيسية)</label>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-bold">
                    حفظ العاملة
                </button>
                <a href="{{ route('admin.workers.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
