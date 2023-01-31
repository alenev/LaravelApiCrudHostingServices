<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpu');
            $table->string('ram');
            $table->string('storage');
            $table->timestamps();
        });


        DB::table('products')->insert(
        array(
            "name" => "Тариф 512",
            "cpu" => "1 CPU Unit",
            "ram" => "512MB",
            "storage" => "20GB SSD"
        ));

        DB::table('products')->insert(
            array(
                "name" => "Тариф 1024",
                "cpu" => "2 CPU Units",
                "ram" => "1024MB",
                "storage" => "40GB SSD"
        ));

        DB::table('products')->insert(
            array(
                "name" => "Тариф 2048",
                "cpu" => "4 СPU Units",
                "ram" => "2048MB",
                "storage" => "80GB SSD"
        ));

        DB::table('products')->insert(
            array(
                "name" => "Тариф 8192",
                "cpu" => "6 CPU Units",
                "ram" => "8192MB",
                "storage" => "120GB SSD"
        ));


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
