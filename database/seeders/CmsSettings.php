<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CmsSettings extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $Setting = Setting::create([
            'display_name' => 'Sidebar',
            'key' => 'sidebar',
            'value' => 1,
            'type' => 'text',
            'visible' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
    }
}
