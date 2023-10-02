<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permission\Role;
use Illuminate\Database\Seeder;

class RolesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=RolesTableDataSeeder

        Role::updateOrCreate([
            'name' => 'super-admin','guard_name'=> 'web',
            'title'=>'الأدمن العام'
        ]);

        //evaluation

        Role::updateOrCreate([
            'name' => 'rates','guard_name'=> 'web',
            'title'=>'طلبات التقييم'
        ]);

        Role::updateOrCreate([
            'name' => 'transaction','guard_name'=> 'web',
            'title'=>'معاملات التقييم'
        ]);

    }
}