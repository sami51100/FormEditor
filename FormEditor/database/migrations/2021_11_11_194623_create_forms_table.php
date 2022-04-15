<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description');
            $table->datetime('date');
            $table->string('color');
            $table->integer('progress');
            $table->longText('formulaire')->nullable();
            $table->softDeletes();
            $table->string('logo', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('forms');
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
