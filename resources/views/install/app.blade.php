@extends('install.layout')
@section('title', 'إعدادات التطبيق')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>إعدادات التطبيق ⚙️</h1>
        <p>أدخل المعلومات الأساسية لموقعك</p>
        <div class="steps">
            <div class="step done"></div>
            <div class="step done"></div>
            <div class="step active"></div>
            <div class="step"></div>
            <div class="step"></div>
        </div>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert-error">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>
        @endif
        <form method="POST" action="{{ route('install.app.save') }}">
            @csrf
            <div class="form-group">
                <label>اسم الموقع *</label>
                <input type="text" name="app_name" value="{{ old('app_name', 'مهارات للاستقدام') }}" required>
            </div>
            <div class="form-group">
                <label>رابط الموقع (URL) *</label>
                <input type="url" name="app_url" value="{{ old('app_url', request()->getSchemeAndHttpHost()) }}" required dir="ltr">
            </div>
            <div class="form-group">
                <label>المنطقة الزمنية</label>
                <select name="app_timezone">
                    <option value="Asia/Riyadh" selected>Asia/Riyadh (توقيت الرياض)</option>
                    <option value="Asia/Dubai">Asia/Dubai</option>
                    <option value="Asia/Kuwait">Asia/Kuwait</option>
                    <option value="Asia/Bahrain">Asia/Bahrain</option>
                    <option value="Asia/Qatar">Asia/Qatar</option>
                    <option value="UTC">UTC</option>
                </select>
            </div>
            <div style="margin-top:1.5rem;">
                <button type="submit" class="btn">التالي: إنشاء حساب المدير →</button>
            </div>
        </form>
    </div>
</div>
@endsection
