<?php

namespace integradora\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orden extends Model
{
    use SoftDeletes;
    protected $table='ordenes';
    public $timestamps=false;
    protected $fillable=[
        'factura_id','producto_id','especialidad_id','precio','cantidad','comentario'
    ];
    protected $dates=['delete_at'];

    public function Factura()
    {
    	return $this->belongsTo(Factura::class,'factura_id')
      ->withTrashed();
    }
    public function Producto()
    {
    	return $this->belongsTo(Producto::class,'producto_id')
      ->withTrashed();
    }
    public function Especialidad()
    {
    	return $this->belongsTo(Especialidad::class,'especialidad_id')
      ->withTrashed();
    }
}
