<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_permission', function (Blueprint $table) {
            $table->uuid('menu_permission_id');
            $table->primary('menu_permission_id');
            $table->uuid('role_menu_id');
            $table->uuid('permission_id');

            $table->foreign('role_menu_id')
                  ->references('role_menu_id')
                  ->on('role_menu')
                  ->onDelete('cascade');

            $table->foreign('permission_id')
                  ->references('permission_id')
                  ->on('permission')
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
        Schema::dropIfExists('menu_permission');
    }
}
