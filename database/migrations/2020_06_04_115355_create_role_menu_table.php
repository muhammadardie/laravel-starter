<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_menu', function (Blueprint $table) {
            $table->uuid('role_menu_id');
            $table->primary('role_menu_id');
            $table->uuid('menu_id');
            $table->uuid('role_id');

            $table->foreign('menu_id')
                  ->references('menu_id')
                  ->on('menu')
                  ->onDelete('cascade');

            $table->foreign('role_id')
                  ->references('role_id')
                  ->on('role')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_menu');
    }
}
