<?php

namespace App\Utils;

use App\Models\Empresa;

//classes NFePHP
use NFePHP\Common\Certificate;
use NFePHP\DA\MDFe\Damdfe;
use NFePHP\MDFe\Complements;
use NFePHP\MDFe\Make;
use NFePHP\MDFe\Common\Standardize;
use NFePHP\MDFe\Tools;

class ConfigTools
{

    private $empresaLogada;

    public static function config($empresa)
    {
        $config = self::configManifesto($empresa);
        $certificado = self::certificado();
        try {
           $tools = new Tools($config, $certificado);

        } catch (\Throwable $th) {
            return '';
        }
        return $tools;
    }

    private static function configManifesto($empresa)
    {
        //self::$empresaLogada = Empresa::where('id', $empresa)->first();

        $config = [
            "atualizacao" => date('Y-m-d H:i:s'),
            "tpAmb" => 2,//self::$empresaLogada->ambiente,
            "razaosocial" => 'ADRIANA E MEDEIROS LTDA ME',//self::$empresaLogada->nome,
            "cnpj" => '02178670000128',//self::$empresaLogada->cnpj,
            "ie" => '200794507',//self::$empresaLogada->insc_estadual,
            "siglaUF" => 'RN',//self::$empresaLogada->estado->uf,
            "versao" => '3.00'
        ];

        return json_encode($config);

    }

    private static function certificado()
    {
        $file = storage_path() . '/app/public/certificados/CE-2022.pfx'; //. self::$empresaLogada->certificado;


        if (file_exists($file)) {
            return Certificate::readPfx(
                file_get_contents($file),
                'ffvm9936'
                //self::$empresaLogada->certificado_senha
            );
        }
    }

    public static function statusServico($empresa)
    {
        try {
            $response = self::config($empresa);
            $status = $response->sefazStatus();
            $standard = new Standardize();
            $standard = $standard->toStd($status);
            return response()->json(
                [
                    'tpAmb' => $standard->tpAmb,
                    'cStat' => $standard->cStat,
                    'xMotivo' => $standard->xMotivo,
                    'cUF' => $standard->cUF,
                    'versao' => $standard->attributes->versao
                ]
            ,200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error ao verificar o status => '. $th->getMessage()
            ],500);
        }

    }


}
