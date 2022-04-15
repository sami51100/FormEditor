<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('role_nom');
            $table->string('role_couleur');
        });
        $this->ajouterRoleDefaut();
    }

    private function ajouterRoleDefaut()
    {
        $this->insererRoleDB(1, 'Admin', '#161616');
        $this->insererRoleDB(2, 'Modérateur', '#d64036');
        $this->insererRoleDB(3, 'Etudiant', '#0080ff');
        $this->insererRoleDB(4, 'Professionnel', '#00ff4c');
        $this->insererRoleDB(5, 'Particulier', '#ffa600');
    }

    private function insererRoleDB(int $id, string $role_nom, string $role_couleur)
    {
        DB::table('roles')->insert([
            'id' => $id,
            'role_nom' => $role_nom,
            'role_couleur' => $role_couleur,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
