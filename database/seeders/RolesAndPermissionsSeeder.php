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
            Permission::create(['name' => 'edit-client']);
            Permission::create(['name' => 'delete-client']);


          // Create roles
          $adminRole = Role::create(['name' => 'admin']);
          $librarianRole = Role::create(['name' => 'librarian']);
          $clientRole = Role::create(['name' => 'client']);

            // Assign permissions to roles
            $adminRole->givePermissionTo('create-book');
            $adminRole->givePermissionTo('edit-book');
            $adminRole->givePermissionTo('delete-book');
            $adminRole->givePermissionTo('switch-user');
            $adminRole->givePermissionTo('delete-user');
            $adminRole->givePermissionTo('create-category');
            $adminRole->givePermissionTo('delete-category');
            $adminRole->givePermissionTo('edit-client');
           

            $librarianRole->givePermissionTo('create-book');
            $librarianRole->givePermissionTo('edit-book');
            $librarianRole->givePermissionTo('delete-book');
            $librarianRole->givePermissionTo('edit-client');
            $librarianRole->givePermissionTo('delete-client');
            $librarianRole->givePermissionTo('create-category');
            $librarianRole->givePermissionTo('delete-category');

    

        
    }
}
