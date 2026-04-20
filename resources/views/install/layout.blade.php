<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'معالج التثبيت') - مهارات للاستقدام</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Tajawal', sans-serif; background: #f1f5f9; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem 1rem; }
        .card { background: #fff; border-radius: 1.5rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08); width: 100%; max-width: 640px; overflow: hidden; }
        .card-header { background: linear-gradient(135deg, #1d4ed8, #059669); color: #fff; padding: 2rem; }
        .card-header h1 { font-size: 1.5rem; font-weight: 800; }
        .card-header p { font-size: 0.875rem; opacity: 0.8; margin-top: 0.25rem; }
        .steps { display: flex; gap: 0.5rem; margin-top: 1.5rem; }
        .step { flex: 1; height: 4px; border-radius: 2px; background: rgba(255,255,255,0.3); }
        .step.done { background: #fff; }
        .step.active { background: rgba(255,255,255,0.7); }
        .card-body { padding: 2rem; }
        .form-group { margin-bottom: 1.25rem; }
        label { display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem; }
        input[type=text], input[type=email], input[type=password], input[type=url], select { width: 100%; border: 1px solid #d1d5db; border-radius: 0.6rem; padding: 0.65rem 0.875rem; font-size: 0.875rem; font-family: inherit; color: #1f2937; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        input:focus, select:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.15); }
        .btn { display: inline-block; background: #2563eb; color: #fff; padding: 0.75rem 2rem; border-radius: 0.75rem; font-weight: 700; font-family: inherit; font-size: 1rem; cursor: pointer; border: none; transition: background 0.2s; text-decoration: none; }
        .btn:hover { background: #1d4ed8; }
        .btn-success { background: #059669; }
        .btn-success:hover { background: #047857; }
        .btn-secondary { background: #e5e7eb; color: #374151; }
        .btn-secondary:hover { background: #d1d5db; }
        .alert-error { background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; border-radius: 0.6rem; padding: 0.75rem 1rem; font-size: 0.875rem; margin-bottom: 1.5rem; }
        .req-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.6rem 0; border-bottom: 1px solid #f3f4f6; font-size: 0.875rem; }
        .req-item:last-child { border: none; }
        .ok { color: #16a34a; font-weight: 700; }
        .fail { color: #dc2626; font-weight: 700; }
        .hint { font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem; }
    </style>
    @stack('styles')
</head>
<body>
    @yield('content')
</body>
</html>
