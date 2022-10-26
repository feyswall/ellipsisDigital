<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Creating the admin Role */
        $adminRole = Role::create(['name' => "adminRole"]);

        /** create user Role */
        $userRole = Role::create(['name' => 'userRole']);

        /** creating the permissions for our admin  */
        $adminPermissions = [
            'books_access',
            'book_create',
            'book_show',
            'book_edit',
            'book_delete',

            'user_access',
            'user_create',
            'user_show',
            'user_edit',
            'user_delete'
        ];

        /** creating permissions  for our user */
        $userPermissions = [
            'book_show'
        ];



        foreach ( $adminPermissions as $permission ){
            $adminRole->givePermissionTo($permission);
        }

        foreach ( $userPermissions as $permission ){
            $userRole->givePermissionTo( $permission );
        }
    }
}
