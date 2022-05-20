<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManifestoValidation
{

    private static function validarCondutor($values) {
        foreach ($values as $condutor) {

            $validateCondutor = Validator::make($condutor, [
                'nome' => ['required'],
                'cpf' => ['required']
                ],
                [

                ],
                [
                    'nome' => 'Nome do condutor',
                    'cpf' => 'CPF do condutor'
                ]
            );
            $validateCondutor->validate();
        }

    }

    private static function validarCiot($values)
    {
        foreach ($values as $ciot) {

            $validateCiot = Validator::make($ciot, [

                'cpfcnpj' => ['required'],
                'ciot' => ['required']
                ],
                [

                ],
                [
                    'ciot' => 'Numero do ciot',
                    'cpfcnpj' => 'CPF/CNPJ do contratante.'
                ]
            );
            $validateCiot->validate();
        }
    }

    private static function validarCpfcnpj($values, $entidade)
    {

        foreach ($values as $value) {

            $validateCpfcnpj = Validator::make($value, [

                'cpfcnpj' => ['required']
                ],
                [

                ],
                [
                    'cpfcnpj' => 'CPF/CNPJ do(a) ' . $entidade
                ]
            );
            $validateCpfcnpj->validate();
        }
    }

    public static function  validacoes(Request $request)
    {
        $validationData = $request->all();
        self::validarCondutor($validationData['condutores']);

        if (isset($validationData['contratantes']))
            self::validarCpfcnpj($validationData['contratantes'], 'Contratante');

        if (isset($validationData['ciots']))
            self::validarCiot($validationData['ciots']);

        if (isset($validationData['autorizacaos']))
            self::validarCpfcnpj($validationData['autorizacaos'], 'Autorizado(a)');
    }


}
