<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=AdminsTableDataSeeder

        User::updateOrCreate(
            [
                'email' => 'admin@admin.com',
            ],
            [
                'name' => 'Super Admin',
                'mobile' => '+01003265652',
                'password' => 'admin@123',
            ]
        );
    }
}
