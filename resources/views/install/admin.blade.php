@extends('install.layout')
@section('title', 'إنشاء حساب المدير')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>حساب المدير العام 👤</h1>
        <p>ستستخدم هذه البيانات لتسجيل الدخول إلى لوحة التحكم</p>
        <div class="steps">
            <div class="step done"></div>
            <div class="step done"></div>
            <div class="step done"></div>
            <div class="step active"></div>
            <div class="step"></div>
        </div>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert-error">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>
        @endif
        <form method="POST" action="{{ route('install.admin.save') }}">
            @csrf
            <div class="form-group">
                <label>الاسم الكامل *</label>
                <input type="text" name="admin_name" value="{{ old('admin_name') }}" required placeholder="مدير النظام">
            </div>
            <div class="form-group">
                <label>البريد الإلكتروني *</label>
                <input type="email" name="admin_email" value="{{ old('admin_email') }}" required dir="ltr" placeholder="admin@example.com">
            </div>
            <div class="form-group">
                <label>كلمة المرور *</label>
                <input type="password" name="admin_password" required autocomplete="new-password">
                <p class="hint">8 أحرف على الأقل</p>
            </div>
            <div class="form-group">
                <label>تأكيد كلمة المرور *</label>
                <input type="password" name="admin_password_confirmation" required autocomplete="new-password">
            </div>
            <div style="margin-top:1.5rem;">
                <button type="submit" class="btn">التالي: البيانات التجريبية →</button>
            </div>
        </form>
    </div>
</div>
@endsection
