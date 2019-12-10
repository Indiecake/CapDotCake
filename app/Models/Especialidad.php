<?php

namespace integradora\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Especialidad extends Model
{
    use SoftDeletes;
    protected $table= 'especialidades';
    protected $fillable=['nombre'];
    public $timestamps= false;
    protected $dates=['delete_at'];

    public function Ordenes()
    {
    	return $this->hasMany(Orden::class)
      ->withTrashed();
    }  
}
