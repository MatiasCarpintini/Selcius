<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function articulos()
    {
    	return $this->hasMany('Selcius\Articulo');
    }
}
