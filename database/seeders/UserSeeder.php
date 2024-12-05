<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@ex.fr',
            'password' => Hash::make('password'),
        ]);

        // Créer une équipe associée à cet utilisateur
        $team = Team::create([
            'user_id' => $user->id, // Propriétaire de l'équipe
            'name' => $user->name . "'s Team",
            'personal_team' => true,
        ]);

        $user = User::where('email', 'admin@ex.fr')->first();
        $adminRole = Role::find('admin');
        $user->roles()->attach($adminRole);
        $user->createToken('auth_token')->plainTextToken;

        $user->ownedTeams()->save($team);

        $user->teams()->attach($team, ['role' => 'owner']);
    }
}
