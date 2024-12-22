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
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Créer les permissions
        Permission::create(['name' => 'creer les taches']);
        Permission::create(['name' => 'editer les taches']);
        Permission::create(['name' => 'supprimer les taches']);
        Permission::create(['name' => 'consulter les taches']);

        // Créer les rôles et leur assigner des permissions
        $roleAdmin = Role::create(['name' => 'ADMIN']);
        $roleAdmin->givePermissionTo(Permission::all());

        $roleUser = Role::create(['name' => 'USER']);
        $roleUser->givePermissionTo(['editer les taches', 'consulter les taches']);
    }
}
