@extends('install.layout')
@section('title', 'إعداد قاعدة البيانات')

@push('styles')
<style>
    #test-result { display:none; margin-top:0.75rem; padding:0.6rem 0.875rem; border-radius:0.5rem; font-size:0.875rem; }
    .result-ok { background:#f0fdf4; color:#15803d; border:1px solid #86efac; }
    .result-fail { background:#fef2f2; color:#b91c1c; border:1px solid #fca5a5; }
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <h1>إعداد قاعدة البيانات 🗄️</h1>
        <p>أدخل بيانات الاتصال بقاعدة البيانات MySQL</p>
        <div class="steps">
            <div class="step done"></div>
            <div class="step active"></div>
            <div class="step"></div>
            <div class="step"></div>
            <div class="step"></div>
        </div>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $e){{ $e }}<br>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('install.database.save') }}" id="db-form">
            @csrf
            <div class="form-group">
                <label>عنوان الخادم (Host)</label>
                <input type="text" name="db_host" value="{{ old('db_host', '127.0.0.1') }}" required dir="ltr">
            </div>
            <div class="form-group">
                <label>اسم قاعدة البيانات</label>
                <input type="text" name="db_name" value="{{ old('db_name') }}" required dir="ltr" placeholder="maharat">
            </div>
            <div class="form-group">
                <label>اسم المستخدم</label>
                <input type="text" name="db_user" value="{{ old('db_user', 'root') }}" required dir="ltr">
            </div>
            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" name="db_pass" dir="ltr" autocomplete="off">
                <p class="hint">اتركها فارغة إذا لا توجد كلمة مرور</p>
            </div>

            <div id="test-result"></div>

            <div style="display:flex;gap:0.75rem;margin-top:1.5rem;flex-wrap:wrap;">
                <button type="button" onclick="testConnection()" class="btn btn-secondary">🔌 اختبار الاتصال</button>
                <button type="submit" class="btn">التالي: إعدادات التطبيق →</button>
            </div>
        </form>
    </div>
</div>
<script>
function testConnection() {
    const form = document.getElementById('db-form');
    const data = new FormData(form);
    const resultEl = document.getElementById('test-result');
    resultEl.style.display = 'block';
    resultEl.className = '';
    resultEl.textContent = 'جاري الاختبار...';

    fetch('{{ route('install.database.test') }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': data.get('_token'), 'Accept': 'application/json', 'Content-Type': 'application/json' },
        body: JSON.stringify({
            db_host: data.get('db_host'),
            db_name: data.get('db_name'),
            db_user: data.get('db_user'),
            db_pass: data.get('db_pass'),
        })
    })
    .then(r => r.json())
    .then(res => {
        resultEl.className = res.success ? 'result-ok' : 'result-fail';
        resultEl.textContent = res.message;
    })
    .catch(() => {
        resultEl.className = 'result-fail';
        resultEl.textContent = 'حدث خطأ في الاتصال';
    });
}
</script>
@endsection
