<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::ROLES_LABEL as $roleKey => $role) {
            $roleExists = DB::table('roles')->where('name', $roleKey)->first();

            if (!$roleExists) {
                Role::create(['name' => $roleKey]);
            }
        }
    }
}
