<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Selcius\Http\Requests;
use Selcius\Comentario;
use Selcius\User;
use Auth;
use Selcius\Curso;
use Session;
use Purifier;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request, $curso_id)
    {
        $this->validate($request, [
            'comentario' => 'required'
            ]);
        $curso = Curso::find($curso_id);
        $users = User::all();
        $comentario = new Comentario;
        $comentario->comentario = Purifier::clean($request->comentario);
        $comentario->curso()->associate($curso);
        $comentario->user_id = Auth::user()->id;
        $comentario->approved = true;

        $comentario->save();

        return redirect()->route('courses.single', $comentario->curso->slug);
    }

    public function edit($id)
    {
        $comentario = Comentario::find($id);
        return view('comentarios.edit')->withComentario($comentario);
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
        $comentario = Comentario::find($id);
        $this->validate($request, [
            'comentario' => 'required'
        ]);
        $comentario->comentario = Purifier::clean($request->input('comentario'));

            $comentario->save();

        return redirect()->route('courses.single', $comentario->curso->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comentario = Comentario::find($id);
        $curso_id = $comentario->curso->id; 
        $comentario->delete();

        return redirect()->route('courses.single', $comentario->curso->slug);  
    }
}
