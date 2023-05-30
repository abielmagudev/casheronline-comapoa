<?php

namespace App\Models;

use App\Models\Features\AyudasTabla;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CuentaAsociada extends Model
{
    use AyudasTabla;

    public $timestamps = false;
    
    protected $table = 'cuentas';

    protected $fillable = [
        'cuenta',
        'id_usuario',
    ];


    // Attributes

    public function getNumeroAttribute()
    {
        return $this->cuenta;
    }

    public function getNumeroNombreAttribute()
    {
        return sprintf('%s - %s', $this->numero, $this->padron->NOMBRE);
    }


    // Scopes

    public function scopeWhereNumero($query, $numero)
    {
        return $query->where('cuenta', $numero);
    }

    public function scopeWhereUsuario($query, $id_usuario)
    {
        return $query->where('id_usuario', $id_usuario);
    }

    public function scopeAutenticado($query)
    {
        return $query->where('id_usuario', Auth::id());
    }


    // Relationships

    public function padron()
    {
        return $this->hasOne(Padron::class, 'CUENTA', 'cuenta');
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id', 'id_usuario');
    }


    // Store

    public static function prepararParaGuardar(array $validated)
    {
        return [
            'cuenta' => $validated['numero'],
            'id_usuario' => $validated['id_usuario'],
        ];
    }

    public static function guardarRelacionDirecta(string $numero, $id_usuario = null)
    {
        $preparados = self::prepararParaGuardar([
            'numero' => $numero,
            'id_usuario' => $id_usuario ?? Auth::id(),
        ]);

        return self::create($preparados);
    }
}
