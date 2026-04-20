<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'مهارات للاستقدام')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap');
        body { font-family: 'Tajawal', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="text-2xl font-extrabold text-blue-700">مهارات للاستقدام</a>
                <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition">الرئيسية</a>
                    <a href="{{ route('workers.index') }}" class="hover:text-blue-600 transition">العمالة</a>
                    <a href="{{ route('services') }}" class="hover:text-blue-600 transition">خدماتنا</a>
                    <a href="{{ route('prices') }}" class="hover:text-blue-600 transition">الأسعار</a>
                    <a href="{{ route('faq') }}" class="hover:text-blue-600 transition">الأسئلة الشائعة</a>
                    @auth
                        @if(in_array(auth()->user()->role, ['admin','super_admin']))
                            <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">لوحة التحكم</a>
                        @else
                            <a href="{{ route('client.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">حسابي</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 transition">خروج</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">تسجيل الدخول</a>
                    @endauth
                </div>
                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-600" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col gap-3 text-sm font-medium">
                    <a href="{{ route('home') }}" class="hover:text-blue-600">الرئيسية</a>
                    <a href="{{ route('workers.index') }}" class="hover:text-blue-600">العمالة</a>
                    <a href="{{ route('services') }}" class="hover:text-blue-600">خدماتنا</a>
                    <a href="{{ route('prices') }}" class="hover:text-blue-600">الأسعار</a>
                    <a href="{{ route('faq') }}" class="hover:text-blue-600">الأسئلة الشائعة</a>
                    @auth
                        <a href="{{ route('client.dashboard') }}" class="text-blue-600">حسابي</a>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-600">تسجيل الدخول</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-blue-400">مهارات للاستقدام</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">وكالة متخصصة في استقدام العمالة المنزلية المدربة من أفضل الدول الآسيوية والأفريقية.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">روابط سريعة</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('workers.index') }}" class="hover:text-white transition">استعراض العمالة</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">خدماتنا</a></li>
                        <li><a href="{{ route('prices') }}" class="hover:text-white transition">الأسعار</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-white transition">الأسئلة الشائعة</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">تواصل معنا</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>📞 +966 50 000 0000</li>
                        <li>📧 info@maharat.com</li>
                        <li>📍 المملكة العربية السعودية</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                © {{ date('Y') }} مهارات للاستقدام - جميع الحقوق محفوظة
            </div>
        </div>
    </footer>
</body>
</html>
