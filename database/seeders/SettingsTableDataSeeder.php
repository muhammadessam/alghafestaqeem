<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=SettingsTableDataSeeder

        Setting::create([
            'email' => 'info@alghafestaqeem.com',
            'phone' => '0507125558',
            'whats_app' => '966530491112',
            'facebook' => '',
            'twitter' => 'https://twitter.com/salehalghafes',
            'youTube' => 'https://www.youtube.com/watch?v=Z7ORSfcQRgA',
            'instagram' => '',
            'footer' => 'جميع الحقوق محفوظة لـ   شركة صالح بن علي الغفيص للتقييم العقاري 2023 ©',
            'service' => 'نقدم في شركة صالح الغفيص أفضل الخدمات للمستفيدين في جميع مناطق المملكة.',
            'objective' => 'نهدف في شركة صالح الغفيص لأن نكون خيارك الأول في التقييم العقاري.',
            'about' => 'تفخر شركة صالح علي الغفيص بحصولها على أول عضوية لدى الهيئة السعودية للمقيمين المعتمدين بمنطقة القصيم وحصولها على أول ترخيص مزاولة لمهنة التقييم العقاري بالمنطقة. حيث سعينا منذ وقت مبكر على التواصل مع الهيئة السعودية للمقيمين المعتمدين إيماناً منا بأهمية مهنة التقييم وتطويرها وتنظيمها ليكون العمل بالمهنة وفق الأنظمة والمعايير الدولية.​',
            'title' => 'شركة صالح بن علي الغفيص للتقييم العقاري',
        ]);
    }
}
