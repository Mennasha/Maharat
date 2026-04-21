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
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="text-2xl font-extrabold text-blue-700">مهارات للاستقدام</a>
                <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <button id="dark-toggle" onclick="toggleDark()" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700 transition" title="تبديل الوضع">
                        <svg id="dark-icon-sun" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 7a5 5 0 100 10 5 5 0 000-10z"/></svg>
                        <svg id="dark-icon-moon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    </button>
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition">الرئيسية</a>
                    <a href="{{ route('workers.index') }}" class="hover:text-blue-600 transition">العمالة</a>
                    <a href="{{ route('services') }}" class="hover:text-blue-600 transition">خدماتنا</a>
                    <a href="{{ route('prices') }}" class="hover:text-blue-600 transition">الأسعار</a>
                    <a href="{{ route('faq') }}" class="hover:text-blue-600 transition">الأسئلة الشائعة</a>
                    <a href="{{ route('about') }}" class="hover:text-blue-600 transition">من نحن</a>
                    <a href="{{ route('contact') }}" class="hover:text-blue-600 transition">تواصل معنا</a>
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
                    <a href="{{ route('about') }}" class="hover:text-blue-600">من نحن</a>
                    <a href="{{ route('contact') }}" class="hover:text-blue-600">تواصل معنا</a>
                    @auth
                        <a href="{{ route('client.dashboard') }}" class="text-blue-600">حسابي</a>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-600">تسجيل الدخول</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-4 left-1/2 -translate-x-1/2 z-[9999] flex flex-col gap-2 w-full max-w-sm px-4 pointer-events-none"></div>
    @if(session('success'))
    <script>window.__toasts = window.__toasts||[];window.__toasts.push({type:'success',msg:{{ Js::from(session('success')) }}});</script>
    @endif
    @if(session('error'))
    <script>window.__toasts = window.__toasts||[];window.__toasts.push({type:'error',msg:{{ Js::from(session('error')) }}});</script>
    @endif

    <!-- Content -->
    @yield('content')

    <!-- WhatsApp Floating Button -->
    @php $wa = \App\Models\Setting::get('site_whatsapp','966500000000'); @endphp
    @if($wa)
    <a href="https://wa.me/{{ $wa }}" target="_blank"
       class="fixed bottom-6 left-6 z-50 bg-green-500 hover:bg-green-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg transition"
       title="تواصل عبر واتساب">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    @php $siteName = \App\Models\Setting::get('site_name', 'مهارات للاستقدام'); @endphp
                    <h3 class="text-xl font-bold mb-4 text-blue-400">{{ $siteName }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">وكالة متخصصة في استقدام العمالة المنزلية المدربة من أفضل الدول الآسيوية والأفريقية.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">روابط سريعة</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('workers.index') }}" class="hover:text-white transition">استعراض العمالة</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">خدماتنا</a></li>
                        <li><a href="{{ route('prices') }}" class="hover:text-white transition">الأسعار</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-white transition">الأسئلة الشائعة</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">من نحن</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">تواصل معنا</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        @php
                            $phone   = \App\Models\Setting::get('site_phone','');
                            $email   = \App\Models\Setting::get('site_email','');
                            $address = \App\Models\Setting::get('site_address','');
                        @endphp
                        @if($phone)<li>📞 {{ $phone }}</li>@endif
                        @if($email)<li>📧 {{ $email }}</li>@endif
                        @if($address)<li>📍 {{ $address }}</li>@else<li>📍 المملكة العربية السعودية</li>@endif
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">نموذج التواصل</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                © {{ date('Y') }} {{ $siteName }} - جميع الحقوق محفوظة
            </div>
        </div>
    </footer>
    @stack('scripts')
    <script>
    (function(){
        function showToast(type,msg){
            var c=document.getElementById('toast-container');
            var t=document.createElement('div');
            var isSuccess=type==='success';
            t.className='pointer-events-auto flex items-center gap-3 px-5 py-3 rounded-xl shadow-lg text-sm font-medium transition-all duration-300 opacity-0 translate-y-2 '+(isSuccess?'bg-green-500 text-white':'bg-red-500 text-white');
            t.innerHTML='<svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="'+(isSuccess?'M5 13l4 4L19 7':'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z')+'"/></svg><span class="flex-1">'+msg+'</span><button onclick="this.parentElement.remove()" class="opacity-70 hover:opacity-100 text-lg leading-none">&times;</button>';
            c.appendChild(t);
            requestAnimationFrame(function(){t.classList.remove('opacity-0','translate-y-2');});
            setTimeout(function(){t.classList.add('opacity-0');setTimeout(function(){t.remove();},300);},4000);
        }
        document.addEventListener('DOMContentLoaded',function(){
            (window.__toasts||[]).forEach(function(n){showToast(n.type,n.msg);});
        });
    })();
    </script>
    <script>
    function toggleDark() {
        var html = document.documentElement;
        html.classList.toggle('dark');
        localStorage.setItem('darkMode', html.classList.contains('dark') ? '1' : '0');
        document.getElementById('dark-icon-sun').classList.toggle('hidden', !html.classList.contains('dark'));
        document.getElementById('dark-icon-moon').classList.toggle('hidden', html.classList.contains('dark'));
    }
    (function() {
        var stored = localStorage.getItem('darkMode');
        var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (stored === '1' || (stored === null && prefersDark)) {
            document.documentElement.classList.add('dark');
            var sun = document.getElementById('dark-icon-sun');
            var moon = document.getElementById('dark-icon-moon');
            if(sun) { sun.classList.remove('hidden'); }
            if(moon) { moon.classList.add('hidden'); }
        }
    })();
    </script>
</body>
</html>
