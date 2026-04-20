<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Worker;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Faq;
use App\Models\Service;
use App\Models\NationalityPrice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin users
        User::create(['name'=>'مدير النظام','email'=>'admin@maharat.com','password'=>Hash::make('password'),'role'=>'admin','email_verified_at'=>now()]);
        User::create(['name'=>'المدير العام','email'=>'superadmin@maharat.com','password'=>Hash::make('password'),'role'=>'super_admin','email_verified_at'=>now()]);

        // Workers
        $workers = [
            ['name'=>'ماريا سانتوس','nationality'=>'فلبينية','age'=>28,'religion'=>'مسيحية','marital_status'=>'عزباء','language'=>'الإنجليزية والعربية','height'=>158,'weight'=>55,'experience_years'=>3,'previous_countries'=>['السعودية','الكويت'],'skills'=>['تنظيف','طبخ','رعاية أطفال'],'expected_salary'=>1200,'status'=>'available','is_featured'=>true],
            ['name'=>'أميرة تكلي','nationality'=>'إثيوبية','age'=>25,'religion'=>'مسيحية','marital_status'=>'عزباء','language'=>'العربية','height'=>162,'weight'=>58,'experience_years'=>2,'previous_countries'=>['السعودية'],'skills'=>['تنظيف','طبخ'],'expected_salary'=>900,'status'=>'available','is_featured'=>true],
            ['name'=>'ديوي رحمواتي','nationality'=>'إندونيسية','age'=>30,'religion'=>'إسلامية','marital_status'=>'متزوجة','language'=>'العربية والإنجليزية','height'=>155,'weight'=>52,'experience_years'=>5,'previous_countries'=>['السعودية','الإمارات','الكويت'],'skills'=>['طبخ','تنظيف','رعاية أطفال','رعاية مسنين'],'expected_salary'=>1100,'status'=>'available','is_featured'=>true],
            ['name'=>'بريا كومار','nationality'=>'هندية','age'=>32,'religion'=>'هندوسية','marital_status'=>'متزوجة','language'=>'الإنجليزية','height'=>160,'weight'=>60,'experience_years'=>4,'previous_countries'=>['الكويت','البحرين'],'skills'=>['طبخ','تنظيف'],'expected_salary'=>1000,'status'=>'available','is_featured'=>true],
            ['name'=>'نيلوفر سيلفا','nationality'=>'سريلانكية','age'=>27,'religion'=>'بوذية','marital_status'=>'عزباء','language'=>'الإنجليزية','height'=>157,'weight'=>54,'experience_years'=>3,'previous_countries'=>['السعودية'],'skills'=>['تنظيف','رعاية أطفال'],'expected_salary'=>950,'status'=>'available','is_featured'=>true],
            ['name'=>'سيتا ثاباليا','nationality'=>'نيبالية','age'=>24,'religion'=>'هندوسية','marital_status'=>'عزباء','language'=>'الإنجليزية','height'=>153,'weight'=>50,'experience_years'=>1,'previous_countries'=>[],'skills'=>['تنظيف','طبخ'],'expected_salary'=>850,'status'=>'available','is_featured'=>true],
        ];
        foreach ($workers as $w) Worker::create($w);

        // Testimonials
        Testimonial::create(['client_name'=>'أم محمد','content'=>'خدمة ممتازة وسريعة، العاملة التي استقدمناها محترفة جداً','rating'=>5,'is_active'=>true]);
        Testimonial::create(['client_name'=>'أبو عبدالله','content'=>'تعاملت مع المكتب للمرة الثانية وكل مرة أفضل من السابقة','rating'=>5,'is_active'=>true]);
        Testimonial::create(['client_name'=>'أم سارة','content'=>'أنصح الجميع بهذا المكتب، الاحترافية والمصداقية في التعامل','rating'=>4,'is_active'=>true]);

        // Partners
        Partner::create(['name'=>'وكالة الخليج','country'=>'الكويت','is_active'=>true]);
        Partner::create(['name'=>'مكتب الأمانة','country'=>'الفلبين','is_active'=>true]);
        Partner::create(['name'=>'شركة النخبة','country'=>'إندونيسيا','is_active'=>true]);

        // FAQs
        Faq::create(['question'=>'كم تستغرق عملية الاستقدام؟','answer'=>'تستغرق عملية الاستقدام عادةً من 30 إلى 60 يوم عمل من تاريخ توقيع العقد حتى وصول العاملة.','order'=>1,'is_active'=>true]);
        Faq::create(['question'=>'هل يوجد ضمان على العاملة؟','answer'=>'نعم، نقدم ضماناً لمدة 3 أشهر. في حال عدم التوافق يتم استبدال العاملة مجاناً.','order'=>2,'is_active'=>true]);
        Faq::create(['question'=>'ما هي الجنسيات المتاحة؟','answer'=>'نوفر عاملات من: الفلبين، إندونيسيا، إثيوبيا، الهند، سريلانكا، نيبال، وغيرها.','order'=>3,'is_active'=>true]);

        // Services
        Service::create(['title'=>'استقدام عمالة منزلية','description'=>'نوفر عمالة منزلية مدربة ومختارة بعناية من أفضل الدول','icon'=>'🏠','price'=>5000,'is_active'=>true]);
        Service::create(['title'=>'استبدال العمالة','description'=>'خدمة الاستبدال في حال عدم التوافق مع العاملة خلال فترة الضمان','icon'=>'🔄','price'=>1500,'is_active'=>true]);
        Service::create(['title'=>'تجديد الإقامة','description'=>'نساعد في إجراءات تجديد إقامة العاملة المنزلية','icon'=>'📋','price'=>800,'is_active'=>true]);

        // Nationality prices
        NationalityPrice::create(['nationality'=>'فلبينية','price'=>12000,'notes'=>'شاملة جميع الرسوم','is_active'=>true]);
        NationalityPrice::create(['nationality'=>'إندونيسية','price'=>11000,'notes'=>'شاملة جميع الرسوم','is_active'=>true]);
        NationalityPrice::create(['nationality'=>'إثيوبية','price'=>9000,'notes'=>'شاملة جميع الرسوم','is_active'=>true]);
        NationalityPrice::create(['nationality'=>'هندية','price'=>10000,'notes'=>'شاملة جميع الرسوم','is_active'=>true]);
        NationalityPrice::create(['nationality'=>'سريلانكية','price'=>10500,'notes'=>'شاملة جميع الرسوم','is_active'=>true]);
        NationalityPrice::create(['nationality'=>'نيبالية','price'=>9500,'notes'=>'شاملة جميع الرسوم','is_active'=>true]);
    }
}

