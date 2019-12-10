<?php

namespace integradora\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
	use SoftDeletes;
    protected $table='productos';
    public $timestamps=false;
    protected $fillable=[
    	'nombre','precio',
    ];
    protected $dates=['delete_at'];

    public function Ordenes()
    {
    	return $this->hasMany(Orden::class)
			->withTrashed();
    }

}
