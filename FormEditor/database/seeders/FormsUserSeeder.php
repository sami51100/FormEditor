<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Forms;
use App\Models\FormsUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rowForms = DB::table("forms")->where('deleted_at', NULL)->get();
        $countForms = count($rowForms);

        DB::table('forms_user')->delete(); // au lieu de truncate
        $forms_id = Forms::all()->pluck('id');
        $user_id = Forms::all()->pluck('user_id');
        for ($i = 0; $i < $countForms; $i++) {
            DB::insert('insert into forms_user (forms_id, user_id) values (?, ?)', [$forms_id[$i], $user_id[$i]]);
        }
        // penser à ajouter quelque utilisateur de manière aléatoire dans des groupes
    }
}
