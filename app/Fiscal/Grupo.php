<?php

namespace App\Fiscal;

abstract class Grupo
{
    public abstract static function load($make, $query);
}
