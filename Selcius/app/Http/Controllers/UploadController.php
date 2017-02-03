<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Selcius\Http\Requests;
use Selcius\Http\Controllers\Controller;
use Selcius\Upload;
use Selcius\Message;
use Selcius\Curso;
use Selcius\User;
use Selcius\Auth;
use Input;
use Session;
use Purifier;
use Image;
use Storage;

class UploadController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::all();
        return view('class.create')->withCursos($cursos);
    }

    public function show($slug)
    {
        $upload = Upload::where('slug','=', $slug)->first();
        $messages = Message::all();
        $uploads = Upload::all();
        $cursos = Curso::all();
        return view('class.show')->withUpload($upload)->withMessages($messages)->withCursos($cursos)->withUploads($uploads);
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
            'slug' => 'required|max:44',
            'curso_id' => 'required|integer',
            'user_id' => 'required|integer',
            'title' => 'required',
            'description' => 'required|min:10',
            'featured_file' => 'required|file'
            ]);

        $upload = new Upload;
        $upload->slug = Purifier::clean($request->slug);
        $upload->curso_id = $request->curso_id;
        $upload->user_id = $request->user_id;
        $upload->title = $request->title;
        $upload->description = Purifier::clean($request->description);

        //Storage the File in the DB
        $file = Input::file('featured_file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $location = public_path('videos/');

        $file->move($location, $filename);

        $upload->file = $filename;

        $upload->save();

        return redirect()->route('class.show', $upload->slug);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cursos = Cursos::all();
        $upload = Upload::find($id);
        return view('class.edit')->withUpload($upload)->withCursos($cursos);
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
        $upload = Upload::find($id);
        $this->validate($request, [
            'slug' => 'required|max:44',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'featured_file' => 'required|file'
        ]);
        $upload->slug = Purifier::clean($request->input('slug'));
        $upload->title = $request->input('title');
        $upload->description = Purifier::clean($request->input('description'));

        $file = Input::file('featured_file');
        $filename = time();
        $name = $filename.'.'.$file->getClientOriginalExtension();
        $location = public_path('videos/' . $name);

        $file->move($location, $name);

        $upload->file = $name;

        $upload->save();

        return redirect()->route('class.show', $upload->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upload = Upload::find($id);
        Storage::delete($upload->file);
        $upload->delete();

        return redirect()->route('cursos.index');
    }
}
