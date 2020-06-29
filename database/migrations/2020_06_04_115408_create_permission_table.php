<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->uuid('permission_id');
            $table->primary('permission_id');
            $table->string('name');
            $table->string('action');
            $table->string('description');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('permission');
    }
}
