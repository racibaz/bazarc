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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('two_factor_type', ['off', 'sms', 'app'])->default('off');
            $table->string('authy_id')->unique()->nullable();
            $table->string('slug')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('web_site')->nullable();
            $table->boolean('gender')->nullable();
            $table->text('bio_note')->nullable();
            $table->string('IP')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('previous_visit')->nullable();
            $table->unsignedInteger('status')->default(0);
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
