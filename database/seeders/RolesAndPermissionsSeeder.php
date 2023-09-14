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
        $arrayOfPermission= ['entreprise','dashboard','produit','service','fournisseur','categorie','facture_achat','client','facture_vente','user','role','creer','editer','voir','supprimer','archiver','restorer'];
        $permissions = collect($arrayOfPermission)->map(function($permission){
            return ['name'=>$permission , 'guard_name'=>'web'];
        });

        Permission::insert($permissions->toArray());

        $role = Role::create(['name'=>'owner'])
        ->givePermissionTo($arrayOfPermission);
    }
}
