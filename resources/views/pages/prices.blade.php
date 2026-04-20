@extends('layouts.app')

@section('title', 'أسعار الاستقدام')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-3">أسعار الاستقدام</h1>
        <p class="text-gray-500 text-lg">أسعار شفافة وتنافسية لجميع الجنسيات</p>
    </div>

    @if($prices->count())
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
        <table class="w-full">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-right font-bold text-lg">الجنسية</th>
                    <th class="px-6 py-4 text-center font-bold text-lg">السعر (ريال)</th>
                    <th class="px-6 py-4 text-right font-bold text-lg">ملاحظات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($prices as $price)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800 text-lg">
                        🌍 {{ $price->nationality }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-2xl font-extrabold text-blue-600">{{ number_format($price->price) }}</span>
                        <span class="text-gray-500 text-sm mr-1">ريال</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-sm">{{ $price->notes ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-5">
        <h3 class="font-bold text-yellow-800 mb-2">⚠️ تنبيه مهم</h3>
        <p class="text-yellow-700 text-sm">الأسعار المذكورة هي أسعار تقريبية قد تتغير حسب الظروف والطلب. للحصول على سعر دقيق تواصل معنا مباشرة.</p>
    </div>
    @else
    <div class="text-center py-16">
        <p class="text-gray-500 text-lg">لا توجد أسعار متاحة حالياً</p>
    </div>
    @endif

    <div class="mt-10 text-center">
        <a href="{{ route('workers.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-bold ml-3">
            استعراض العمالة
        </a>
        <a href="{{ route('services') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 transition font-bold">
            خدماتنا
        </a>
    </div>
</div>
@endsection
