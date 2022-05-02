<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert(
            [
                ['id'=>1,'uf'=>'EX','nome'=>'Exterior','pais_id'=>31,'cod_ibge'=>0]
                ,['id'=>2,'uf'=>'RO','nome'=>'Rondônia','pais_id'=>31,'cod_ibge'=>11]
                ,['id'=>3,'uf'=>'AC','nome'=>'Acre','pais_id'=>31,'cod_ibge'=>12]
                ,['id'=>4,'uf'=>'AM','nome'=>'Amazônia','pais_id'=>31,'cod_ibge'=>13]
                ,['id'=>5,'uf'=>'RR','nome'=>'Raraima','pais_id'=>31,'cod_ibge'=>14]
                ,['id'=>6,'uf'=>'PA','nome'=>'Pará','pais_id'=>31,'cod_ibge'=>15]
                ,['id'=>7,'uf'=>'AP','nome'=>'Amapá','pais_id'=>31,'cod_ibge'=>16]
                ,['id'=>8,'uf'=>'TO','nome'=>'Tocantins','pais_id'=>31,'cod_ibge'=>17]
                ,['id'=>9,'uf'=>'MA','nome'=>'Maranhão','pais_id'=>31,'cod_ibge'=>21]
                ,['id'=>10,'uf'=>'PI','nome'=>'Piauí','pais_id'=>31,'cod_ibge'=>22]
                ,['id'=>11,'uf'=>'CE','nome'=>'Ceará','pais_id'=>31,'cod_ibge'=>23]
                ,['id'=>12,'uf'=>'RN','nome'=>'Rio Grande do Norte','pais_id'=>31,'cod_ibge'=>24]
                ,['id'=>13,'uf'=>'PB','nome'=>'Paraíba','pais_id'=>31,'cod_ibge'=>25]
                ,['id'=>14,'uf'=>'PE','nome'=>'Pernambuco','pais_id'=>31,'cod_ibge'=>26]
                ,['id'=>15,'uf'=>'AL','nome'=>'Alagoas','pais_id'=>31,'cod_ibge'=>27]
                ,['id'=>16,'uf'=>'SE','nome'=>'Sergipe','pais_id'=>31,'cod_ibge'=>28]
                ,['id'=>17,'uf'=>'BA','nome'=>'Bahia','pais_id'=>31,'cod_ibge'=>29]
                ,['id'=>18,'uf'=>'MG','nome'=>'Minas Gerais','pais_id'=>31,'cod_ibge'=>31]
                ,['id'=>19,'uf'=>'ES','nome'=>'Espírito Santo','pais_id'=>31,'cod_ibge'=>32]
                ,['id'=>20,'uf'=>'RJ','nome'=>'Rio de Janeiro','pais_id'=>31,'cod_ibge'=>33]
                ,['id'=>21,'uf'=>'SP','nome'=>'São Paulo','pais_id'=>31,'cod_ibge'=>35]
                ,['id'=>22,'uf'=>'PR','nome'=>'Paraná','pais_id'=>31,'cod_ibge'=>41]
                ,['id'=>23,'uf'=>'SC','nome'=>'Santa Catarina','pais_id'=>31,'cod_ibge'=>42]
                ,['id'=>24,'uf'=>'RS','nome'=>'Rio Grande do Sul','pais_id'=>31,'cod_ibge'=>43]
                ,['id'=>25,'uf'=>'MS','nome'=>'Mato Grosso do Sul','pais_id'=>31,'cod_ibge'=>50]
                ,['id'=>26,'uf'=>'MT','nome'=>'Mato Grosso','pais_id'=>31,'cod_ibge'=>51]
                ,['id'=>27,'uf'=>'GO','nome'=>'Goiás','pais_id'=>31,'cod_ibge'=>52]
                ,['id'=>28,'uf'=>'DF','nome'=>'Distrito Federal','pais_id'=>31,'cod_ibge'=>53],

            ]

        );
    }
}
