<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Selcius\Http\Requests;
use Selcius\Articulo;
use Selcius\User;

class SelciusController extends Controller
{
  	public function getIndex()
  	{
  		$articulos = Articulo::orderBy('id', 'desc')-> paginate(10);

  		return view('articulo.index')->withArticulos($articulos);
  	}
    public function getSingle($slug)
    {
   		$articulo = Articulo::where('slug','=', $slug)-> first();
   		$users = User::all();
   		return view('articulo.single')-> withArticulo($articulo)->withUsers($users);
    }
    
}