<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $ownerRole = Role::create([
            'name'=>'owner'
        ]);

        $fundraiser = Role::create([
            'name'=>'fundraiser'
        ]);

        $userOwner = User::create([
            'name'=>'Tirta Samara',
            'avatar'=>'images/default-avatar.png',
            'email'=>'tirta@owner.com',
            'password'=>bcrypt('admin123')
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
