<?php

namespace Database\Seeders;

use App\Models\UserEmpresa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PaisSeeder::class,
            EstadoSeeder::class,
            MunicipioSeeder::class,
            EmpresaSeeder::class,
            UserEmpresa::class,
        ]);
    }
}
