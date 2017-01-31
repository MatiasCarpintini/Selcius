<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Selcius\Category;
use Selcius\Articulo;
use Selcius\Http\Requests;
use Session;

class CategoryContoller extends Controller
{

    public function __construct()
    {
        $this ->middleware ('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index')->withCategories($categories); 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this ->validate($request, array('name' => 'required|max:255|min:5'));

        $category = new Category;

        $category->name = $request->name;

        $category->save();

        Session::flash('success', 'La categoría fue creada exitosamente!');

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit')->withCategory($category);
    }
    public function show($id)
    {
        $category = Category::find($id);
        $articulos = Articulo::all();
        return view('categories.show')->withCategory($category)->withArticulos($articulos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|min:5'
            ]);
        $category = Category::find($id);
        $category->name = $request->input('name');

        $category->save();

        Session::flash('success', 'Categoria Actualizada Exitosamente!');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index');
    }
}
