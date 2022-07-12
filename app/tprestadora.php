<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tprestadora extends Model
{
    protected $table='tprestadora';
    protected $primaryKey='id_prestadora';
    protected $fillable=['id_prestadora'];
    public $incrementing = false;
}
