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
        <!-- Sidebar (RTL: fixed on the right) -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col fixed top-0 right-0 h-full z-40">
            <div class="p-6 border-b border-gray-700">
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-400">مهارات للاستقدام</a>
                <p class="text-xs text-gray-400 mt-1">لوحة الإدارة</p>
            </div>
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    لوحة التحكم
                </a>
                <a href="{{ route('admin.workers.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.workers.*') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    إدارة العمالة
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    إدارة الطلبات
                </a>

                <div class="pt-3 pb-1">
                    <p class="text-xs text-gray-500 uppercase tracking-wider px-4">إدارة المحتوى</p>
                </div>
                <a href="{{ route('admin.testimonials.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    التقييمات
                </a>
                <a href="{{ route('admin.partners.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.partners.*') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    الشركاء
                </a>
                <a href="{{ route('admin.faqs.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.faqs.*') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    الأسئلة الشائعة
                </a>
                <a href="{{ route('admin.services.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.services.*') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    الخدمات
                </a>
                <a href="{{ route('admin.prices.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.prices.*') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    أسعار الجنسيات
                </a>
                <a href="{{ route('admin.contact-requests.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.contact-requests.*') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    رسائل التواصل
                </a>
                <a href="{{ route('admin.settings.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    إعدادات الموقع
                </a>
            </nav>
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-start text-red-400 hover:text-red-300 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        تسجيل الخروج
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content (RTL: margin on the left = ml-64) -->
        <div class="flex-1 ml-64">
        <!-- Top Header -->
        <header class="bg-white shadow-sm px-6 py-3 sticky top-0 z-30">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-base font-bold text-gray-800">@yield('page-title', 'لوحة التحكم')</h1>
                    <nav class="text-xs text-gray-400 mt-0.5">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition">الرئيسية</a>
                        @hasSection('breadcrumb')
                            <span class="mx-1">›</span>
                            @yield('breadcrumb')
                        @endif
                    </nav>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="text-sm text-gray-400 hover:text-blue-600 transition hidden sm:block">
                        عرض الموقع ↗
                    </a>
                    {{-- Notification Bell --}}
                    @php $unreadCount = \App\Models\ContactRequest::where('is_read', false)->count(); @endphp
                    <a href="{{ route('admin.contact-requests.index') }}" class="relative p-2 text-gray-500 hover:text-blue-600 transition rounded-lg hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        @if($unreadCount > 0)
                        <span class="absolute -top-0.5 -end-0.5 w-4 h-4 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center font-bold">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                        @endif
                    </a>
                    <span class="text-gray-300 hidden sm:block">|</span>
                    <span class="font-medium text-gray-800 text-sm">{{ auth()->user()->name }}</span>
                    <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full hidden sm:block">
                        {{ auth()->user()->role === 'super_admin' ? 'مدير عام' : 'مدير' }}
                    </span>
                </div>
            </div>
        </header>

            <!-- Toast session data -->
            @if(session('success'))
            <script>window.__toasts = window.__toasts||[];window.__toasts.push({type:'success',msg:{{ Js::from(session('success')) }}});</script>
            @endif
            @if(session('error'))
            <script>window.__toasts = window.__toasts||[];window.__toasts.push({type:'error',msg:{{ Js::from(session('error')) }}});</script>
            @endif

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
    <div id="toast-container" class="fixed top-4 left-1/2 -translate-x-1/2 z-[9999] flex flex-col gap-2 w-full max-w-sm px-4 pointer-events-none"></div>
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
</body>
</html>
