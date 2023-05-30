<?php

namespace App\Models\Features;

trait AyudasTabla
{
    protected static $instancia_ayuda;

    public static function instanciaAyuda()
    {
        if( is_null(self::$instancia_ayuda) )
            self::$instancia_ayuda = new self;

        return self::$instancia_ayuda;
    }

    public static function obtenerNombreTabla()
    {
        return self::instanciaAyuda()->getTable();
    }

    public static function obtenerAliasTabla()
    {
        return self::instanciaAyuda()->table_alias;
    }

    public static function obtenerNombreAliasTabla()
    {
        return sprintf('%s AS $s', self::obtenerNombreTabla(), self::obtenerAliasTabla());
    }
}
