<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;

use Selcius\Http\Requests;

use Selcius\Curso;

use Selcius\User;

use Selcius\Comentario;

use Selcius\Upload;

use Selcius\Section;

class CourseController extends Controller
{
    public function getIndex()
    {
        $cursos = Curso::orderBy('id', 'desc')->paginate(10);
        $sections = Section::orderBy('id', 'desc')->paginate(10);
        
        return view('courses.index')->withCursos($cursos)->withSections($sections);
    }
    public function getSingle($slug)
    {
        $curso = Curso::where('slug','=', $slug)-> first();
        $uploads = Upload::all();
        return view('courses.single')-> withCurso($curso)->withUploads($uploads);
    }
}
