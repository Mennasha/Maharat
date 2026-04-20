<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم') - مهارات للاستقدام</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col fixed h-full z-40">
            <div class="p-6 border-b border-gray-700">
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-400">مهارات للاستقدام</a>
                <p class="text-xs text-gray-400 mt-1">لوحة الإدارة</p>
            </div>
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
                    <span>🏠</span> لوحة التحكم
                </a>
                <a href="{{ route('admin.workers.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.workers.*') ? 'bg-blue-600' : '' }}">
                    <span>👥</span> إدارة العمالة
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600' : '' }}">
                    <span>📋</span> إدارة الطلبات
                </a>
            </nav>
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-right text-red-400 hover:text-red-300 transition flex items-center gap-2">
                        <span>🚪</span> تسجيل الخروج
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 mr-64">
            <!-- Top Header -->
            <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
                <h1 class="text-lg font-bold text-gray-700">@yield('page-title', 'لوحة التحكم')</h1>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500">مرحباً،</span>
                    <span class="font-medium text-gray-800">{{ auth()->user()->name }}</span>
                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">
                        {{ auth()->user()->role === 'super_admin' ? 'مدير عام' : 'مدير' }}
                    </span>
                </div>
            </header>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mx-6 mt-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mx-6 mt-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
