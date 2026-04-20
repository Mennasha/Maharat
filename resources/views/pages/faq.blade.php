@extends('layouts.app')

@section('title', 'الأسئلة الشائعة')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-3">الأسئلة الشائعة</h1>
        <p class="text-gray-500 text-lg">إجابات على أكثر الأسئلة شيوعاً</p>
    </div>

    @if($faqs->count())
    <div class="space-y-4">
        @foreach($faqs as $index => $faq)
        <div class="bg-white rounded-2xl shadow-md overflow-hidden" x-data="{ open: {{ $index == 0 ? 'true' : 'false' }} }">
            <button class="w-full text-right px-6 py-5 flex justify-between items-center hover:bg-gray-50 transition"
                    onclick="toggleFaq('faq{{ $faq->id }}', 'icon{{ $faq->id }}')">
                <span class="font-bold text-gray-800 text-lg">{{ $faq->question }}</span>
                <span id="icon{{ $faq->id }}" class="text-blue-600 text-2xl transition-transform">
                    {{ $index == 0 ? '−' : '+' }}
                </span>
            </button>
            <div id="faq{{ $faq->id }}"
                 class="{{ $index == 0 ? '' : 'hidden' }} px-6 pb-5">
                <div class="border-t border-gray-100 pt-4">
                    <p class="text-gray-600 leading-relaxed">{{ $faq->answer }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16">
        <p class="text-gray-500 text-lg">لا توجد أسئلة متاحة حالياً</p>
    </div>
    @endif

    <div class="mt-12 bg-blue-50 rounded-2xl p-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-3">لم تجد إجابتك؟</h2>
        <p class="text-gray-500 mb-5">تواصل معنا مباشرة وسيسعدنا مساعدتك</p>
        <a href="https://wa.me/966500000000" target="_blank"
           class="bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600 transition font-bold inline-block">
            💬 تواصل معنا
        </a>
    </div>
</div>

<script>
function toggleFaq(id, iconId) {
    const content = document.getElementById(id);
    const icon = document.getElementById(iconId);
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.textContent = '−';
    } else {
        content.classList.add('hidden');
        icon.textContent = '+';
    }
}
</script>
@endsection
