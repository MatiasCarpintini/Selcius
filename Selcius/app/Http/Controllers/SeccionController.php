<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Selcius\Http\Requests;
use Selcius\Http\Controllers\Controller;
use Selcius\Curso;
use Selcius\User;
use Selcius\Auth;
use Session;
use Purifier;
use Image;
use Storage;
use Input;
use Selcius\Section;

class SeccionController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::orderBy('id', 'desc')->paginate(10);
        return view('secciones.index')->withSections($sections);
    }

    public function edit($id){
        $section = Section::find($id);
        return view('secciones.edit')->withSection($section);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'featured_icono' => 'required|sometimes|image'       
            ]);
        $section = new Section;
        $section->name = $request->name;

        if($request->hasFile('featured_icono')){
        $icono = $request->file('featured_icono');
        $name = time() . '.' . $icono->getClientOriginalExtension();
        $location = public_path('images/' . $name);

        Image::make($icono)->resize(42, 42)->save($location);

        $section->icono = $name;
        }
        $section->save();

        return redirect()->route('sections.show', $section->id);
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
        $section = Section::find($id);
        $this->validate($request, [
            'name' => 'required',
            'featured_icono' => 'sometimes|image' 
            ]);

        $section->name = $request->name;

        if($request->hasFile('featured_icono')){
        $icono = $request->file('featured_icono');
        $name = time() . '.' . $icono->getClientOriginalExtension();
        $location = public_path('images/' . $name);

        Image::make($icono)->resize(42, 42)->save($location);

        $section->icono = $name;
        }
        $section->save();

        return redirect()->route('sections.show', $section->id);
    }
    public function show($id){
        $section = Section::find($id);
        $cursos = Curso::all();
        return view('secciones.show')->withSection($section)->withCursos($cursos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();

        return redirect()->route('sections.index');
    }
}
