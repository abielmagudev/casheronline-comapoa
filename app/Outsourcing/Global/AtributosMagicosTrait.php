<?php

namespace App\Outsourcing\Global;

trait AtributosMagicosTrait
{
    public function __get($name)
    {
        return method_exists($this, $name) ? call_user_func([$this, $name]) : null;
    }
}
