<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('firstname');
            $table->text('middlename');
            $table->text('lastname');`
            $table->text('sex')-> nullable();
            $table->text('age')-> nullable();
            $table->text('region')-> nullable();
            $table->text('wereda')-> nullable();
            $table->text('kebele')-> nullable();
            $table->text('housenumber')-> nullable();
            $table->text('officenumber')-> nullable();
            $table->text('mobilenumber');
            $table->text('resnumber')-> nullable();
            $table->text('pobox')-> nullable();
            $table->text('synod')-> nullable();
            $table->text('cong')-> nullable();
            $table->text('occupation')-> nullable();
            $table->text('email')-> nullable();
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
        Schema::dropIfExists('Contacts');
    }
}
