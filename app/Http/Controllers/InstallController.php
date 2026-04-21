<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller {

    private function isInstalled(): bool {
        return file_exists(storage_path('installed'));
    }

    public function index() {
        return view('install.welcome', ['requirements' => $this->checkRequirements()]);
    }

    public function database() {
        return view('install.database');
    }

    public function testDatabase(Request $request) {
        $request->validate([
            'db_host' => 'required|string',
            'db_name' => 'required|string',
            'db_user' => 'required|string',
            'db_pass' => 'nullable|string',
        ]);

        try {
            $pdo = new \PDO(
                "mysql:host={$request->db_host};dbname={$request->db_name}",
                $request->db_user,
                $request->db_pass ?? '',
                [\PDO::ATTR_TIMEOUT => 5]
            );
            return response()->json(['success' => true, 'message' => 'تم الاتصال بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'فشل الاتصال: ' . $e->getMessage()]);
        }
    }

    public function saveDatabase(Request $request) {
        $request->validate([
            'db_host' => 'required|string',
            'db_name' => 'required|string',
            'db_user' => 'required|string',
            'db_pass' => 'nullable|string',
        ]);

        session([
            'install_db_host' => $request->db_host,
            'install_db_name' => $request->db_name,
            'install_db_user' => $request->db_user,
            'install_db_pass' => $request->db_pass ?? '',
        ]);

        return redirect()->route('install.app');
    }

    public function app() {
        return view('install.app');
    }

    public function saveApp(Request $request) {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_url'  => 'required|url',
            'app_timezone' => 'required|string',
        ]);

        session([
            'install_app_name'     => $request->app_name,
            'install_app_url'      => $request->app_url,
            'install_app_timezone' => $request->app_timezone,
        ]);

        return redirect()->route('install.admin');
    }

    public function admin() {
        return view('install.admin');
    }

    public function saveAdmin(Request $request) {
        $request->validate([
            'admin_name'     => 'required|string|max:255',
            'admin_email'    => 'required|email',
            'admin_password' => 'required|min:8|confirmed',
        ]);

        session([
            'install_admin_name'     => $request->admin_name,
            'install_admin_email'    => $request->admin_email,
            'install_admin_password' => $request->admin_password,
        ]);

        return redirect()->route('install.seed');
    }

    public function seed() {
        return view('install.seed');
    }

    public function run(Request $request) {
        $dbHost = session('install_db_host');
        $dbName = session('install_db_name');
        $dbUser = session('install_db_user');
        $dbPass = session('install_db_pass');
        $appName = session('install_app_name', 'مهارات للاستقدام');
        $appUrl  = session('install_app_url', 'http://localhost');
        $appTz   = session('install_app_timezone', 'Asia/Riyadh');
        $adminName  = session('install_admin_name');
        $adminEmail = session('install_admin_email');
        $adminPass  = session('install_admin_password');

        if (!$dbHost || !$dbName || !$adminName) {
            return redirect()->route('install.index')->with('error', 'بيانات التثبيت غير مكتملة، أعد المحاولة.');
        }

        try {
            // Write .env (includes freshly generated APP_KEY)
            $envContent = $this->buildEnv($appName, $appUrl, $appTz, $dbHost, $dbName, $dbUser, $dbPass);
            file_put_contents(base_path('.env'), $envContent);

            // Reload config
            Artisan::call('config:clear');
            Artisan::call('cache:clear');

            // Re-configure DB connection dynamically
            config([
                'database.connections.mysql.host' => $dbHost,
                'database.connections.mysql.database' => $dbName,
                'database.connections.mysql.username' => $dbUser,
                'database.connections.mysql.password' => $dbPass,
            ]);
            DB::purge('mysql');
            DB::reconnect('mysql');

            // Run migrations
            Artisan::call('migrate', ['--force' => true]);

            // Optional seeding
            if ($request->boolean('run_seeder')) {
                Artisan::call('db:seed', ['--force' => true]);
            }

            // Create admin user
            $user = \App\Models\User::updateOrCreate(
                ['email' => $adminEmail],
                [
                    'name'     => $adminName,
                    'password' => Hash::make($adminPass),
                    'role'     => 'super_admin',
                ]
            );

            // Mark as installed
            file_put_contents(storage_path('installed'), date('Y-m-d H:i:s'));

            // Clear sessions
            session()->forget(['install_db_host','install_db_name','install_db_user','install_db_pass',
                'install_app_name','install_app_url','install_app_timezone',
                'install_admin_name','install_admin_email','install_admin_password']);

            return redirect()->route('install.success');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'خطأ في التثبيت: ' . $e->getMessage()]);
        }
    }

    public function success() {
        return view('install.success');
    }

    private function checkRequirements(): array {
        return [
            ['label' => 'PHP 8.3+', 'ok' => version_compare(PHP_VERSION, '8.3.0', '>=')],
            ['label' => 'PDO Extension', 'ok' => extension_loaded('pdo')],
            ['label' => 'PDO MySQL', 'ok' => extension_loaded('pdo_mysql')],
            ['label' => 'Mbstring Extension', 'ok' => extension_loaded('mbstring')],
            ['label' => 'OpenSSL Extension', 'ok' => extension_loaded('openssl')],
            ['label' => 'Tokenizer Extension', 'ok' => extension_loaded('tokenizer')],
            ['label' => 'XML Extension', 'ok' => extension_loaded('xml')],
            ['label' => 'مجلد storage قابل للكتابة', 'ok' => is_writable(storage_path())],
            ['label' => 'مجلد bootstrap/cache قابل للكتابة', 'ok' => is_writable(base_path('bootstrap/cache'))],
        ];
    }

    private function buildEnv(string $appName, string $appUrl, string $tz, string $dbHost, string $dbName, string $dbUser, string $dbPass): string {
        $key = 'base64:' . base64_encode(random_bytes(32));
        return <<<ENV
APP_NAME="{$appName}"
APP_ENV=production
APP_KEY={$key}
APP_DEBUG=false
APP_URL={$appUrl}
APP_TIMEZONE={$tz}
APP_LOCALE=ar

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST={$dbHost}
DB_PORT=3306
DB_DATABASE={$dbName}
DB_USERNAME={$dbUser}
DB_PASSWORD={$dbPass}

BROADCAST_CONNECTION=log
CACHE_STORE=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120
ENV;
    }
}
