<?php

namespace App\Models;

class Funcoes
{

    /**
     * Retorna a descriçao do tipo transporte
     */

    public static function tipoTransporte($tipo)
    {
        $aTipoTransp = [
           0 => '',
           1 => 'ETC',
           2 => 'TAC',
           3 => 'CTC',
       ];
       return  $aTipoTransp[$tipo];
    }


   /**
    * Retorna um array com chave e valor dos meses do ano
    * @return array
    */
   public static function monthsOfYear()
   {
       $a = [
           '1' => 'Janeiro',
           '2' => 'Fevereiro',
           '3' => 'Março',
           '4' => 'Abril',
           '5' => 'Maio',
           '6' => 'Junho',
           '7' => 'Julho',
           '8' => 'Agosto',
           '9' => 'Setembro',
           '10' => 'Outubro',
           '11' => 'Novembro',
           '12' => 'Dezembro',
       ];
       return $a;
   }

   /**
    * Adicionar um periodo a data informada
    * @param date $data
    * @param int $count
    * @param string $periodo
    */
   public static function addMonth($data, $count, $periodo = 'M')
   {
       return date_add(new \DateTime($data), new \DateInterval('P' . (string)$count . $periodo))->format('Y-m-d');
   }


   public static function deleteAcentos($texto)
   {
       return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $texto);
   }


   /**
    * Remove os acentos
    * @param string $texto
    * @return string
    */
   public static function removerAcentos($texto)
   {
       $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
       $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

       return str_replace($comAcentos, $semAcentos, $texto);
   }

   /**
    * Formata numero em formato CPF / CNPJ 000.000.000-00 / 00.000.000/0000-00
    * @param string $value
    * @return string
    */
   public static function formatCPFCNPJ($value)
   {
       if (!is_null($value)) {
           if ($value != '') {
               //41.003.278/0001-08
               if (strlen($value) == 14) //cnpj
               {
                   return substr($value, 0, 2) . '.' . substr($value, 2, 3) . '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4) . '-' . substr($value, 12, 2);
               }
               //291.404.338-46
               else if (strlen($value) == 11) //cpf
               {
                   return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
               } else {
                   return $value;
               }
           }
       } else {
           return "";
       }
   }

   /**
    * Retira a formatacao do telefone
    */

   public static function disTelefone($value)
   {
       return str_replace('-', '', str_replace(' ', '', str_replace(')', '', str_replace('(', '', $value))));
   }

   /**
    * Remove pontos e hifens
    * @param string $value
    * @return string
    */
   public static function disCEP($value)
   {
       return str_replace('-', '', $value);
   }

   /**
    * Remove o formato CPF/CNPJ 000.000.000-00 -> 000000000000, 00.000.000/0000-00 -> 00000000000000
    * @param string $value
    * @return string
    */
   public static function disFormatCPFCNPJ($value)
   {
       return str_replace('-', '', str_replace('.', '', str_replace('/', '', $value)));
   }

   /**
    * Formata um numero float em decimal brasileiro com casas decimais informada
    * @param float $numero número ex: 2.34
    * @param int $decimais número de casas decimais
    * @return string número em formato brasileiro, ex: 2,34
    */
   public static function formatFloatBr($numero, $decimais = 2)
   {
       return number_format(isset($numero) ? $numero : 0, $decimais, ',', '.');
   }

   /**
    * Formata decimal brasileiro para decimal float
    * Exemplo: 0,00 -> 0.00 , 12,50 -> 12.50, 1.362,36 -> 1362.36
    * @param string $value
    * @return float
    */
   public static function formatBrFloat($value)
   {
       return ($value != "") ? (float) str_replace(',', '.', str_replace('.', '', $value)) : 0;
   }

   /**
    * Formata date em data no formato especificado, que vem com o formato padrao brasileiro
    * @param date $data
    * @param string $format
    * @return string
    */
   public static function formatDateBr($date, $format = 'd/m/Y')
   {
       return is_null($date) ? '' : date($format,  strtotime($date));
   }

   /**
    * Formata data formato brasileiro em formato americano
    * Exemplo: 15/12/2021 -> 2021-12-15
    * @param string $value
    * @return date
    */
   public static function formatBrDate($value, $format = 'Y-m-d')
   {
       return ($value != "") ? date($format,  strtotime(str_replace('/', '-', $value))) : date('Y-m-d');
   }


   public static function situacaoManifesto($value)
   {
       $aSituacao = [
           1 => 'Digitado',
           2 => 'Transmitido',
           3 => 'Encerrado',
           4 => 'Cancelado'
       ];
       return $aSituacao[$value];
   }

   public static function getStatusPagSeguro($value)
   {
       $tpStatus = [
           0 => '0-Em aberto',
           1 => '1-Aguardando pagto',
           2 => '2-Em analise',
           3 => '3-Paga',
           4 => '4-Disponível',
           5 => '5-Em disputa',
           6 => '6-Devolvida',
           7 => '7-Cancelada',
           8 => '8-Debitado',
           9 => '9-Retenção Temporária',
           10 => '10-Pix'
       ];

       return $tpStatus[$value];
   }

}
