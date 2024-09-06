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
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $record = User::create([
                    'name' => 'Mohamed Atia',
                    'email' => 'atia@admin.com',
                    'password' => bcrypt('2480123m'),
        ]);

        Permission::create([
            'name' => 'mange-site',
        ]);

        Role::create([
            'name' => 'super-admin',
        ]);

        Role::find(1)->givePermissionTo('mange-site');

        User::find(1)->assignRole('super-admin');

        $roles = $record->roles;

        foreach ($roles as $role){
            $permission = $role->permissions;
            $record->givePermissionTo($permission);
        }

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
            'key' => 'about_app',
            'value' => 'Welcome To Sofra App we glad to see you here and hope for you to find what you search about if it is food or drinks or iceCreams !!',
            'type' => 'text',
        ]);
        Setting::create([
            'key' => 'app_commissions_text',
            'value' => 'We will take about 10% about All order you will make',
            'type' => 'text',
        ]);
    }
}
