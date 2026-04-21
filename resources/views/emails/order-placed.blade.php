<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap');
        body { font-family: 'Tajawal', Arial, sans-serif; background: #f3f4f6; margin: 0; padding: 20px; direction: rtl; color: #1f2937; }
        .container { max-width: 580px; margin: 0 auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #1d4ed8, #065f46); color: white; padding: 32px 24px; text-align: center; }
        .header h1 { margin: 0 0 8px; font-size: 22px; }
        .header p { margin: 0; opacity: 0.85; font-size: 14px; }
        .body { padding: 32px 24px; }
        .greeting { font-size: 18px; font-weight: 700; margin-bottom: 12px; }
        .info-box { background: #f9fafb; border-radius: 12px; padding: 20px; margin: 20px 0; border: 1px solid #e5e7eb; }
        .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e5e7eb; font-size: 14px; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #6b7280; }
        .info-value { font-weight: 700; color: #111827; }
        .status-badge { display: inline-block; background: #dbeafe; color: #1d4ed8; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: 700; }
        .btn { display: block; text-align: center; background: #2563eb; color: white; padding: 14px 24px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 15px; margin: 24px 0; }
        .footer { background: #f9fafb; padding: 16px 24px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🎉 تم استلام طلبك</h1>
        <p>مهارات للاستقدام</p>
    </div>
    <div class="body">
        <div class="greeting">مرحباً، {{ $order->client->name ?? 'عزيزنا العميل' }}</div>
        <p style="color:#4b5563;line-height:1.7;">تم استلام طلبك بنجاح وسيقوم فريقنا بمتابعته والتواصل معك في أقرب وقت ممكن.</p>

        <div class="info-box">
            <div class="info-row">
                <span class="info-label">رقم الطلب</span>
                <span class="info-value">#{{ $order->id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">العاملة المطلوبة</span>
                <span class="info-value">{{ $order->worker->name ?? 'غير محدد' }}</span>
            </div>
            @if($order->worker)
            <div class="info-row">
                <span class="info-label">الجنسية</span>
                <span class="info-value">{{ $order->worker->nationality }}</span>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">تاريخ الطلب</span>
                <span class="info-value">{{ $order->created_at->format('Y/m/d') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">الحالة</span>
                <span class="info-value"><span class="status-badge">{{ $order->status_label }}</span></span>
            </div>
        </div>

        <a href="{{ url('/client/orders/' . $order->id) }}" class="btn">تتبع حالة طلبك</a>

        <p style="color:#6b7280;font-size:13px;line-height:1.7;">للاستفسار يمكنك التواصل معنا عبر <a href="{{ url('/contact') }}" style="color:#2563eb;">نموذج التواصل</a> أو الاتصال بنا مباشرة.</p>
    </div>
    <div class="footer">
        © {{ date('Y') }} مهارات للاستقدام — جميع الحقوق محفوظة
    </div>
</div>
</body>
</html>
