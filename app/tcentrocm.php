<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tcentrocm extends Model
{
    protected $table='tcentrocm';
    protected $primaryKey='id_centrocm';
    protected $fillable= ['n_centrocm'];
}
