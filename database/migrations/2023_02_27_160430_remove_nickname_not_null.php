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
        Schema::table('people', function (Blueprint $table) {
            $table->string("nickname")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $people = \App\Models\Person::whereNull("nickname")->get();

        foreach ($people as $person){
            $person->nickname = $person->name;
            $person->save();
        }

        Schema::table('people', function (Blueprint $table) {
            $table->string("nickname")->nullable(false)->change();
        });
    }
};
