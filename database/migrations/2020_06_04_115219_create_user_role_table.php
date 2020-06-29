<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->uuid('user_role_id');
            $table->primary('user_role_id');
            $table->uuid('user_id');
            $table->uuid('role_id');

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('user')
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
        Schema::dropIfExists('user_role');
    }
}
