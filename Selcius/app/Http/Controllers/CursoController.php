<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Selcius\Http\Requests;
use Selcius\Like;
use Selcius\Http\Controllers\Controller;
use Selcius\Curso;
use Selcius\User;
use Selcius\Upload;
use Selcius\Section;
use Selcius\Auth;
use Selcius\Category;
use Selcius\Comentario;
use Session;
use Purifier;
use Image;
use Storage;
use Input;
use Charts;

class CursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chart = Charts::database(Curso::all(), 'area', 'morris')
        ->title('Cursos')
        ->Elementlabel("Total")
        ->dimensions(1000,500)
        ->responsive(true)
        ->lastByDay(14);
        $donut = Charts::database(Curso::all(), 'donut', 'morris')
        ->title('Cursos')
        ->Elementlabel("Total")
        ->dimensions(1000,500)
        ->responsive(true)
        ->lastByDay(14);
        $cursos = Curso::orderBy('id', 'desc')->paginate(10);
        $likes = Like::all();
        $sections = Section::all();
        return view('cursos.index', ['chart' => $chart, 'donut' => $donut])->withCursos($cursos)->withLikes($likes)->withSections($sections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('cursos.create')->withSections($sections);
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
                'title' => 'required|min:5',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:cursos,slug',
                'description' => 'required|min:20',
                'featured_icono' => 'required|sometimes|image',
                'featured_image' => 'required|sometimes|image',
                'video' => 'required|min:5',
                'level' => 'required|integer',
                'section_id' => 'required|integer'
            ]);
            $curso = new Curso;
            $curso->title = $request->title;
            $curso->slug = $request->slug;
            $curso->description = Purifier::clean($request->description);
            $image = Input::file('featured_image');
            $filename = time(   ) . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(728, 90)->save($location);

            $curso->image = $filename;

            $icono = Input::file('featured_icono');
            $name = time() . '.' . $icono->getClientOriginalExtension();
            $ubicacion = public_path('images/' . $name);
            Image::make($icono)->resize(42, 42)->save($ubicacion);

            $curso->icono = $name;


            $curso->video = $request->video;
            $curso->user_id = Auth::user()->id;
            $curso->level = $request->level;
            $curso->section_id = $request->section_id;

            $curso->save();

            return redirect()->route('cursos.show', $curso->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::find($id);
        $uploads = Upload::all();
        $sections = Section::all();
        return view('cursos.show')->withCurso($curso)->withUploads($uploads)->withSections($sections);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::find($id);

        return view('cursos.edit')->withCurso($curso);
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
        $curso = Curso::find($id);
        if ($request->input('slug') == $curso->slug) {
            $this->validate($request, array(
                'title' => 'required|max:255',
                'description' => 'required|min:20',
                'featured_image' => 'sometimes|image',
                'featured_icono' => 'sometimes|image',
                'video'  => 'required|min:5',
                'level' => 'required|integer'
            ));
        } else {
        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug'  => 'required|alpha_dash|min:5|max:255|unique:cursos,slug',
                'description' => 'required|min:20',
                'featured_icono' => 'sometimes|image',
                'featured_image' => 'sometimes|image',
                'video'  => 'required|min:5',
                'level' => 'required|integer'
            ));
        }
            $curso = Curso::find($id);
            $curso->title = $request->input('title');
            $curso->slug = $request->input('slug');
            $curso->description = Purifier::clean($request->input('description'));
            $curso->video = $request->input('video');
            $curso->level = $request->input('level');

            if($request->hasFile('featured_image')){
            $image = Input::file('featured_image');
            $filename = time(). '.' .$image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(728, 90)->save($location);

            $oldFilename = $curso->image;
            $curso->image = $filename;

            Storage::delete($oldFilename);
            }
            if($request->hasFile('featured_icono')){
            $icono = Input::file('featured_icono');
            $name = time(). '.' .$icono->getClientOriginalExtension();
            $ubicacion = public_path('images/' . $name);
            Image::make($icono)->resize(42, 42)->save($ubicacion);

            $oldFile = $curso->icono;
            $curso->icono = $name;

            Storage::delete($oldFile);
            }
            $curso->save();

            return redirect()->route('cursos.show', $curso->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::find($id);

        Storage::delete($curso->image);

        $curso->delete();

        return redirect()->route('cursos.index');
    }
    public function postLikePost(Request $request, $curso_id)
    {
        $curso_id = $request['cursoId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $curso = Curso::find($curso_id);
        if (!$curso) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('curso_id', $curso_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->curso_id = $curso->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}
