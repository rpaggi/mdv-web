<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateMaster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = User::create([
            "name" => "Master",
            "email" => "master@melhordever.com.br",
            "password" => Hash::make("hisoft2023@")
        ]);

        $u->assignRole("admin");
        $u->save();
    }
}
