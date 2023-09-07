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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer("mobile_id");
            $table->foreignId("person_id")->constrained();
            $table->timestamp("sell_date");
            $table->timestamp("first_delivery_date");
            $table->timestamp("last_delivery_date");
            $table->json("especifications");
            $table->string("frame");
            $table->string("status");
            $table->foreignId("prescription_id")->nullable()->constrained();
            $table->timestamp("delivered_at")->nullable();
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
        Schema::dropIfExists('sales');
    }
};
