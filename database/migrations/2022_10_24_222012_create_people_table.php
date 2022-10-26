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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->string("nickname", 30);
            $table->string("document", 11);
            $table->string("address", 150);
            $table->unsignedInteger("address_city_id");
            $table->integer("address_reference");
            $table->string("phone", 11);
            $table->integer("age");
            $table->string("acs", 120);

            $table->foreign("address_city_id")->references("id")->on("cities")->onDelete("CASCADE");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
