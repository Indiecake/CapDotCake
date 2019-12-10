<?php

namespace integradora\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
    use SoftDeletes;
    protected $table='facturas';
    protected $fillable=[
        'cliente_id','fecha','hora','entregada','comentario'
    ];
    public $timestamps= false;
    protected $dates=['delete_at'];

    public function Cliente()
    {
    	return $this->belongsTo(Cliente::class, 'cliente_id')
      ->withTrashed();
    }

    public function Ordenes()
    {
    	return $this->hasMany(Orden::class);
    }
}
