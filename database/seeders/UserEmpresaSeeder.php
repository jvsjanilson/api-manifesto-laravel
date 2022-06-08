<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_empresas')->insert([
            [
                'user_id' => 1,
                'empresa_id' => 1,
            ],
            [
                'user_id' => 1,
                'empresa_id' => 2,
            ],
            [
                'user_id' => 2,
                'empresa_id' => 1,
            ],
        ]);
    }
}
