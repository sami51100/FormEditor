<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete(); // au lieu de truncate
        User::create([
            'firstname' => 'Rahim',
            'lastname' => 'HAYAT',
            'email' => 'rahim.hayat@etudiant.univ-reims.fr',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => '',
            'profile_photo_path' => 'https://miro.medium.com/max/600/0*HVf99uME8t1T1VbA.gif',
            'role_id' => 1,
        ]);
        User::create([
            'firstname' => 'Sami',
            'lastname' => 'DRIOUCHE',
            'email' => 'sami.driouche@etudiant.univ-reims.fr',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => '',
            'profile_photo_path' => 'https://data.whicdn.com/images/331952976/original.gif',
            'role_id' => 2,
        ]);
        User::create([
            'firstname' => 'Chuck',
            'lastname' => 'NORRIS',
            'email' => 'chuck.norris@toto.fr',
            'email_verified_at' => now(),
            'password' => bcrypt('totototo'),
            'remember_token' => '',
            'profile_photo_path' => 'https://thumbs.gfycat.com/InfamousYawningHorseshoecrab-size_restricted.gif',
            'role_id' => 1,
        ]);
        $this->createChuck();
        User::factory()->count(15)->create();
    }

    function createChuck()
    {
        $roleNameChuck = ['MODO', 'EDU', 'PRO', 'PARTICULIER'];
        $roleEmailChuck = ['moderateur', 'etudiant', 'professionnel', 'particulier'];
        $roleRoleChuck = [2, 3, 4, 5];
        for ($i = 0; $i < 4; $i++) {
            User::create([
                'firstname' => 'Chuck ' . $roleNameChuck[$i],
                'lastname' => 'NORRIS',
                'email' => $roleEmailChuck[$i] . '@formeditor.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => '',
                'profile_photo_path' => 'https://thumbs.gfycat.com/InfamousYawningHorseshoecrab-size_restricted.gif',
                'role_id' => $roleRoleChuck[$i],
            ]);
        }
    }
}
