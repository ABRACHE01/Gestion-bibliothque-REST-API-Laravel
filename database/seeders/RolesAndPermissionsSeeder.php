<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // Create permissions
          Permission::create(['name' => 'create-book']);
          Permission::create(['name' => 'edit-book']);
          Permission::create(['name' => 'delete-book']);

               
            Permission::create(['name' => 'switch-user']);
            Permission::create(['name' => 'delete-user']);

            Permission::create(['name' => 'create-category']);
            Permission::create(['name' => 'delete-category']);



          // Create roles
          $adminRole = Role::create(['name' => 'admin']);
          $librarianRole = Role::create(['name' => 'librarian']);
          $clientRole = Role::create(['name' => 'client']);

            // Assign permissions to roles
            $adminRole->givePermissionTo(['create-book', 'edit-book', 'delete-book']);
            $adminRole->givePermissionTo(['switch-user', 'delete-user']);
            $adminRole->givePermissionTo(['create-category', 'delete-category']);
          

            $librarianRole->givePermissionTo(['create-book', 'edit-book', 'delete-book']);  
            $librarianRole->givePermissionTo(['edit-client', 'delete-client']);
            $librarianRole->givePermissionTo(['create-category', 'delete-category']);

        
    }
}
