<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\City;
use App\Models\Meal;
use App\Models\Region;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mohamed Atia',
            'email' => 'atia@admin.com',
            'password' => bcrypt('2480123m'),
        ]);
        City::create([
            'name' => 'المنصورة',
        ]);

        Region::create([
            'name' => 'شارع الجامعة',
            'city_id' => 1,
        ]);
        Category::create([
            'name' => 'Food',
        ]);
        Category::create([
            'name' => 'IceCreams',
        ]);
        Setting::create([
            'about_app' => 'Welcome To Sofra App we glad to see you here and hope for you to find what you search about if it is food or drinks or iceCreams !!',
            'app_commissions_text' => 'We will take about 10% about All order you will make',
        ]);
    }
}
