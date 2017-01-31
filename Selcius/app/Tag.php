<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function articulos()
    {
    	return $this-> belongsToMany('Selcius\Articulo');
    }
}
