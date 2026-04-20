@extends('install.layout')
@section('title', 'تم التثبيت بنجاح!')

@section('content')
<div class="card">
    <div class="card-header" style="background:linear-gradient(135deg,#059669,#0284c7);text-align:center;">
        <div style="font-size:4rem;margin-bottom:0.5rem;">🎉</div>
        <h1>تم التثبيت بنجاح!</h1>
        <p>موقع مهارات للاستقدام جاهز للاستخدام</p>
        <div class="steps">
            <div class="step done"></div>
            <div class="step done"></div>
            <div class="step done"></div>
            <div class="step done"></div>
            <div class="step done"></div>
        </div>
    </div>
    <div class="card-body" style="text-align:center;">
        <p style="color:#374151;margin-bottom:2rem;font-size:1rem;">
            تم تثبيت التطبيق بنجاح وإنشاء حساب المدير. يمكنك الآن الدخول إلى لوحة التحكم وإعداد الموقع.
        </p>
        <div style="display:flex;flex-direction:column;gap:0.75rem;align-items:center;">
            <a href="/admin/dashboard" class="btn btn-success" style="width:240px;text-align:center;">دخول لوحة التحكم →</a>
            <a href="/" class="btn btn-secondary" style="width:240px;text-align:center;">عرض الموقع</a>
        </div>
        <div style="margin-top:2rem;background:#fef9c3;border:1px solid #fbbf24;border-radius:0.75rem;padding:1rem;font-size:0.85rem;color:#92400e;text-align:start;">
            <strong>تنبيه أمني:</strong> تأكد من إزالة صلاحيات الكتابة عن ملف <code>.env</code> وتأمين مجلد <code>storage</code> بعد اكتمال التثبيت.
        </div>
    </div>
</div>
@endsection
