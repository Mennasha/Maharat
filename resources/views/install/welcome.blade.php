@extends('install.layout')
@section('title', 'معالج التثبيت - مرحباً')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>مرحباً بك في معالج التثبيت 🎉</h1>
        <p>سيرشدك هذا المعالج خلال عملية تثبيت مهارات للاستقدام</p>
        <div class="steps">
            <div class="step active"></div>
            <div class="step"></div>
            <div class="step"></div>
            <div class="step"></div>
            <div class="step"></div>
        </div>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <h2 style="font-size:1.1rem;font-weight:700;color:#1f2937;margin-bottom:1rem;">متطلبات النظام</h2>
        @php $allOk = collect($requirements)->every(fn($r) => $r['ok']); @endphp

        <div style="background:#f9fafb;border-radius:0.75rem;padding:1rem;margin-bottom:1.5rem;">
            @foreach($requirements as $req)
            <div class="req-item">
                <span class="{{ $req['ok'] ? 'ok' : 'fail' }}">{{ $req['ok'] ? '✅' : '❌' }}</span>
                <span style="flex:1;color:#374151;">{{ $req['label'] }}</span>
                <span class="{{ $req['ok'] ? 'ok' : 'fail' }}" style="font-size:0.8rem;">{{ $req['ok'] ? 'متوفر' : 'مفقود' }}</span>
            </div>
            @endforeach
        </div>

        @if($allOk)
            <p style="color:#16a34a;font-weight:600;margin-bottom:1.5rem;">✅ جميع المتطلبات متوفرة! يمكنك المتابعة.</p>
            <a href="{{ route('install.database') }}" class="btn">التالي: إعداد قاعدة البيانات →</a>
        @else
            <p style="color:#dc2626;font-weight:600;margin-bottom:1rem;">⚠️ بعض المتطلبات غير متوفرة، يرجى إصلاحها قبل المتابعة.</p>
            <button onclick="location.reload()" class="btn btn-secondary">إعادة الفحص</button>
        @endif
    </div>
</div>
@endsection
