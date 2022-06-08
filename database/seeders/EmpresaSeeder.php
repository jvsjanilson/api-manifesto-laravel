<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert(
            [
                [

                    'nome'=> 'EMPRESA DEMONSTRACAO',
                    'cnpj' => '19856631000135',
                    'insc_estadual' => '205954219',
                    'endereco'=> 'AV SEM NOME',
                    'numero' => '1000',
                    'bairro' => 'CENTRO',
                    'cep' => '59000000',
                    'telefone' => '(84)2000-1000',
                    'celular' => '(84)98836-7305',
                    'email' => 'janilsonjvs@gmail.com',
                    'estado_id' => 12,
                    'municipio_id' => 1161,
                    'uuid' => (string) Uuid::generate(4),
                    'ativo' => 1,
                ],
                [

                    'nome'=> 'CONSTRUVALLE',
                    'cnpj' => '45081384000152',
                    'insc_estadual' => '205978029',
                    'endereco'=> 'AV SEM NOME',
                    'numero' => '1000',
                    'bairro' => 'CENTRO',
                    'cep' => '59000000',
                    'telefone' => '(84)2000-1000',
                    'celular' => '(84)9883673-7305',
                    'email' => 'janilsonjvs@gmail.com',
                    'estado_id' => 12,
                    'municipio_id' => 1161,
                    'uuid' => (string) Uuid::generate(4),
                    'ativo' => 1,
                ],
            ]
        );
    }
}
