<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->primary('user_id');
            $table->string('username', 100)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('is_logged')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at', 0)->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at', 0)->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
