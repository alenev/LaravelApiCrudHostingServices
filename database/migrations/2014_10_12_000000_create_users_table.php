<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                "name" => "Alex",
                "email" => "alex@mail.com",
                "password" => '$2y$10$pI2axG9Mar/G.amG42pKd.cAiBX9jZ3aGX7CBYDnFzKsFBv6cdUEW', // 123456
        ));

        DB::table('users')->insert(
            array(
                "name" => "Will",
                "email" => "will@mail.com",
                "password" => '$2y$10$pI2axG9Mar/G.amG42pKd.cAiBX9jZ3aGX7CBYDnFzKsFBv6cdUEW', // 123456
        ));


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
};
