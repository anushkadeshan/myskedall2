<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('primary_group_id')->default(1);
            $table->string('name', 255);
            $table->string('nickname', 50)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('sex')->nullable();
            $table->string('birth', 20)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->string('neighborhood', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('uf', 10)->nullable();
            $table->string('profession', 255)->nullable();
            $table->string('rg', 30)->nullable();
            $table->string('cpf', 30)->nullable();
            $table->tinyInteger('level')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('have_warning')->default(0);
            $table->tinyInteger('have_group_warning')->default(0);
            $table->string('created_at_ip')->nullable();
            $table->string('last_logging_ip')->nullable();
            $table->string('inclusion_date')->nullable();
            $table->string('last_logging_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
