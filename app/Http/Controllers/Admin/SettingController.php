<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller {
    public function index() {
        $settings = [
            'site_name'    => Setting::get('site_name', 'مهارات للاستقدام'),
            'site_phone'   => Setting::get('site_phone', ''),
            'site_whatsapp'=> Setting::get('site_whatsapp', ''),
            'site_email'   => Setting::get('site_email', ''),
            'site_address' => Setting::get('site_address', ''),
            'site_logo'    => Setting::get('site_logo', ''),
        ];
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request) {
        $request->validate([
            'site_name'     => 'required|string|max:255',
            'site_phone'    => 'nullable|string|max:30',
            'site_whatsapp' => 'nullable|string|max:30',
            'site_email'    => 'nullable|email|max:255',
            'site_address'  => 'nullable|string|max:500',
            'site_logo'     => 'nullable|image|max:2048',
        ]);

        Setting::setMany([
            'site_name'     => $request->site_name,
            'site_phone'    => $request->site_phone,
            'site_whatsapp' => $request->site_whatsapp,
            'site_email'    => $request->site_email,
            'site_address'  => $request->site_address,
        ]);

        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path);
        }

        return redirect()->route('admin.settings.index')->with('success', 'تم حفظ الإعدادات بنجاح');
    }
}
