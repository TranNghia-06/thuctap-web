<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('configurations')->insert([
            ['config_key' => 'site_name', 'value' => 'Bảo tàng Trang sức cổ Việt Nam'],
            ['config_key' => 'contact_email', 'value' => 'contact@baotangtrangsuc.vn'],
            ['config_key' => 'contact_phone', 'value' => '0919 909 483'],
            ['config_key' => 'address', 'value' => '123, Đường AAA, Quận BBB, TP. Hồ Chí Minh'],
            ['config_key' => 'footer_text', 'value' => '© 2025 Bảo tàng Trang sức cổ Việt Nam. All rights reserved.'],
        ]);
    }
}
