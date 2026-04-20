@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="min-h-screen bg-gradient-to-l from-blue-50 to-green-50 flex items-center justify-center py-12 px-4">
    <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">تسجيل الدخول</h1>
            <p class="text-gray-500">أدخل بيانات حسابك للوصول</p>
        </div>

        @if($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-5 text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
                <input type="password" name="password" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4">
                <label for="remember" class="text-sm text-gray-600">تذكرني</label>
            </div>
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-bold text-lg">
                دخول
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-500 text-sm">
                ليس لديك حساب؟
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">إنشاء حساب جديد</a>
            </p>
        </div>

        <div class="mt-4 p-4 bg-gray-50 rounded-lg text-xs text-gray-500">
            <p class="font-bold mb-1">للتجربة:</p>
            <p>مدير: admin@maharat.com / password</p>
        </div>
    </div>
</div>
@endsection
