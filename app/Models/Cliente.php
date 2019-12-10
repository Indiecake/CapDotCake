<?php

namespace integradora\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
	use SoftDeletes;
    protected $table='clientes';
    public $timestamps= false;
    protected $fillable=[
    	'nombre','apaterno','amaterno','calle','numero','colonia','telefono'
    ];
    protected $dates=['delete_at'];

    public function Facturas()
    {
    	return $this->hasMany(Factura::class)
			->withTrashed();
    }
}
