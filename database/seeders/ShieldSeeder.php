<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_atencion","view_any_atencion","create_atencion","update_atencion","restore_atencion","restore_any_atencion","replicate_atencion","reorder_atencion","delete_atencion","delete_any_atencion","force_delete_atencion","force_delete_any_atencion","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_sector","view_any_sector","create_sector","update_sector","restore_sector","restore_any_sector","replicate_sector","reorder_sector","delete_sector","delete_any_sector","force_delete_sector","force_delete_any_sector","view_tramite","view_any_tramite","create_tramite","update_tramite","restore_tramite","restore_any_tramite","replicate_tramite","reorder_tramite","delete_tramite","delete_any_tramite","force_delete_tramite","force_delete_any_tramite","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","widget_IndicadoresAtenciones","widget_AtencionesDiarias"]},{"name":"user","guard_name":"web","permissions":["view_atencion","view_any_atencion","create_atencion","update_atencion","restore_atencion","restore_any_atencion","replicate_atencion","reorder_atencion","delete_atencion","delete_any_atencion","force_delete_atencion","force_delete_any_atencion","view_any_sector","view_sector","view_any_tramite","view_tramite","widget_IndicadoresAtenciones","widget_AtencionesDiarias"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('  Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
