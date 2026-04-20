@extends('install.layout')
@section('title', 'البيانات التجريبية')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>البيانات التجريبية 📦</h1>
        <p>اختر ما إذا كنت تريد تحميل بيانات تجريبية للموقع</p>
        <div class="steps">
            <div class="step done"></div>
            <div class="step done"></div>
            <div class="step done"></div>
            <div class="step done"></div>
            <div class="step active"></div>
        </div>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert-error">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>
        @endif

        <div style="display:grid;gap:1rem;margin-bottom:1.5rem;">
            <label style="display:flex;gap:1rem;align-items:flex-start;background:#f9fafb;border:2px solid #e5e7eb;border-radius:0.75rem;padding:1rem;cursor:pointer;">
                <input type="radio" name="seed_choice" value="yes" style="width:auto;margin-top:0.2rem;" form="seed-form" id="seed-yes">
                <div>
                    <p style="font-weight:700;color:#1f2937;">تحميل بيانات تجريبية</p>
                    <p style="font-size:0.8rem;color:#6b7280;margin-top:0.25rem;">سيتم إضافة عمالة وتقييمات وبيانات نموذجية لمساعدتك في البداية</p>
                </div>
            </label>
            <label style="display:flex;gap:1rem;align-items:flex-start;background:#f9fafb;border:2px solid #e5e7eb;border-radius:0.75rem;padding:1rem;cursor:pointer;">
                <input type="radio" name="seed_choice" value="no" style="width:auto;margin-top:0.2rem;" form="seed-form" id="seed-no" checked>
                <div>
                    <p style="font-weight:700;color:#1f2937;">البدء بموقع فارغ</p>
                    <p style="font-size:0.8rem;color:#6b7280;margin-top:0.25rem;">تثبيت نظيف بدون أي بيانات تجريبية</p>
                </div>
            </label>
        </div>

        <form id="seed-form" method="POST" action="{{ route('install.run') }}">
            @csrf
            <input type="hidden" name="run_seeder" id="run_seeder_input" value="0">
            <button type="submit" class="btn btn-success" onclick="document.getElementById('run_seeder_input').value = document.getElementById('seed-yes').checked ? '1' : '0'">
                🚀 تثبيت الآن
            </button>
        </form>
    </div>
</div>
@endsection
