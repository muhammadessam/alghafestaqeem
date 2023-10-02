<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission\Permission;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

class MainPermissionsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create main permission module
        //php artisan db:seed --class=MainPermissionsTableDataSeeder
        ini_set('memory_limit', '-1');
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Permission::updateOrCreate(['title' => 'AboutSettings','guard_name'=> 'web', 'name' => 'bio.module']);
        Permission::updateOrCreate(['title' => 'AppServices','guard_name'=> 'web', 'name' => 'services.module']);
        Permission::updateOrCreate(['title' => 'Evaluation','guard_name'=> 'web', 'name' => 'evaluations.module']);
        Permission::updateOrCreate(['title' => 'Categories','guard_name'=> 'web', 'name' => 'categories.module']);
        Permission::updateOrCreate(['title' => 'admins','guard_name'=> 'web', 'name' => 'admins.module']);

        /**1 */
        Permission::updateOrCreate(['title' => 'About','guard_name'=> 'web', 'name' => 'about', 'parent_id' => 1]);
        Permission::updateOrCreate(['title' => 'WebsiteSetting','guard_name'=> 'web', 'name' => 'settings', 'parent_id' => 1]);
        Permission::updateOrCreate(['title' => 'Counters','guard_name'=> 'web', 'name' => 'counters', 'parent_id' => 1]);
        Permission::updateOrCreate(['title' => 'Objectives','guard_name'=> 'web', 'name' => 'objectives', 'parent_id' => 1]);
        Permission::updateOrCreate(['title' => 'Clients','guard_name'=> 'web', 'name' => 'clients', 'parent_id' => 1]);
        Permission::updateOrCreate(['title' => 'Dashboard','guard_name'=> 'web', 'name' => 'dashboard', 'parent_id' => 1]);

        /**2*/
        Permission::updateOrCreate(['title' => 'Services','guard_name'=> 'web', 'name' => 'services', 'parent_id' => 2]);
        Permission::updateOrCreate(['title' => 'CompanyServices','guard_name'=> 'web', 'name' => 'company-services', 'parent_id' => 2]);
        Permission::updateOrCreate(['title' => 'Companies','guard_name'=> 'web', 'name' => 'companies', 'parent_id' => 2]);

        /**3*/
        Permission::updateOrCreate(['title' => 'Rates','guard_name'=> 'web', 'name' => 'rates', 'parent_id' => 3]);
        Permission::updateOrCreate(['title' => 'EvaluationTransactions','guard_name'=> 'web', 'name' => 'evaluation-transactions', 'parent_id' => 3]);
        Permission::updateOrCreate(['title' => 'EvaluationEmployees','guard_name'=> 'web', 'name' => 'evaluation-employees', 'parent_id' => 3]);
        Permission::updateOrCreate(['title' => 'EvaluationCompanies','guard_name'=> 'web', 'name' => 'evaluation-companies', 'parent_id' => 3]);
        Permission::updateOrCreate(['title' => 'cities','guard_name'=> 'web', 'name' => 'cities', 'parent_id' => 3]);

        /**4*/
        Permission::updateOrCreate(['title' => 'Goals','guard_name'=> 'web', 'name' => 'goals','parent_id' => 4]);
        Permission::updateOrCreate(['title' => 'Types','guard_name'=> 'web', 'name' => 'types', 'parent_id' => 4]);
        Permission::updateOrCreate(['title' => 'Entities','guard_name'=> 'web', 'name' => 'entities', 'parent_id' => 4]);
        Permission::updateOrCreate(['title' => 'Usages','guard_name'=> 'web', 'name' => 'usages', 'parent_id' => 4]);

        /**5 */
        Permission::updateOrCreate(['title' => 'Admins','guard_name'=> 'web', 'name' => 'admins', 'parent_id' => 5]);
        Permission::updateOrCreate(['title' => 'Roles','guard_name'=> 'web', 'name' => 'roles', 'parent_id' => 5]);


        $permissions = [
            ['title' => 'Dashboard', 'name' => 'dashboard', 'type' => [0]],
            ['title' => 'About', 'name' => 'about', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'WebsiteSetting', 'name' => 'settings', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'Counters', 'name' => 'counters', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'Objectives', 'name' => 'objectives', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'Clients', 'name' => 'clients', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'Services', 'name' => 'services', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'CompanyServices', 'name' => 'company-services', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'Companies', 'name' => 'companies', 'type' => [0, 1, 2, 3, 4]],

            ['title' => 'Goals', 'name' => 'goals', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'Types', 'name' => 'types', 'type' => [0, 1, 2, 3,4]],
            ['title' => 'Entities', 'name' => 'entities', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'Usages', 'name' => 'usages', 'type' => [0, 1, 2, 3, 4]],

            ['title' => 'Admins', 'name' => 'admins', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'Roles', 'name' => 'roles', 'type' => [0, 1, 2, 3, 4]],

            ['title' => 'Rates', 'name' => 'rates', 'type' => [0, 1, 2, 3, 4,5]],

            ['title' => 'EvaluationTransaction', 'name' => 'evaluation-transactions', 'type' => [0, 1, 2, 3, 4,5]],
            ['title' => 'EvaluationEmployees', 'name' => 'evaluation-employees', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'EvaluationCompanies', 'name' => 'evaluation-companies', 'type' => [0, 1, 2, 3, 4]],
            ['title' => 'cities', 'name' => 'cities', 'type' => [0, 1, 2, 3, 4]],

        ];
        $crudOperations = [
            ['title' => 'Index', 'name' => 'index', 'type' => 0],
            ['title' => 'Show', 'name' => 'show', 'type' => 1],
            ['title' => 'Create', 'name' => 'create', 'type' => 2],
            ['title' => 'Edit', 'name' => 'edit', 'type' => 3],
            ['title' => 'Delete', 'name' => 'delete', 'type' => 4],
            ['title' => 'ChangeStatus', 'name' => 'change-status', 'type' => 5],

        ];

        foreach ($permissions as $permission) {
            //get main permission
            $parent = Permission::where('name', $permission['name'])->first();
            if (!empty($parent)) {
                foreach ($crudOperations as $operation) {
                    if (in_array($operation['type'], $permission['type'])) {
                        Permission::updateOrCreate([
                            'title' => $operation['title'] . ' ' . $permission['title'],
                            'name' => $permission['name'] . '.' . $operation['name'],
                            'permission_id' => $parent->id,
                            'type' => $operation['type'],
                            'guard_name'=> 'web',
                        ]);
                    }
                }
            }
        }
    }
}