<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                    'cnpj' => '02178670000128',
                    'insc_estadual' => '200794507',
                    'endereco'=> 'AV SEM NOME',
                    'numero' => '1000',
                    'bairro' => 'CENTRO',
                    'cep' => '59000000',
                    'telefone' => '(84)2000-1000',
                    'celular' => '(84)9883673-7305',
                    'email' => 'janilsonjvs@gmail.com',
                    'estado_id' => 12,
                    'municipio_id' => 1161,
                    'ativo' => 1,
                ],
            ]
        );
    }
}
