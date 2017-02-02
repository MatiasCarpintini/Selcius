<?php

namespace Selcius\Http\Controllers;

use Selcius\User;
use Selcius\Comment;
use Selcius\Articulo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Selcius\Http\Requests;
use Selcius\Http\Controllers\Controller;
use Selcius\Auth;
use Selcius\Curso;
use Selcius\Foro;
use Selcius\Upload;
use Session;
use Purifier;
use Image;
use Storage;
use Charts;

class UserController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }
    public function index()
    {
        $articulos = Articulo::orderBy('id', 'desc')-> paginate(10);
        return view ('articulos.index')-> withArticulos($articulos);
    }
    public function dashboard(){
        $chart = Charts::database(User::all(), 'area', 'morris')
        ->title('Usuarios')
        ->Elementlabel("Total")
        ->dimensions(1000,500)
        ->responsive(true)
        ->lastByDay(30);
        $users = User::all();
        $cursos = Curso::all();
        $articulos = Articulo::all();
        $foros = Foro::all();
        $uploads = Upload::all();
        return view('auth.dashboard', ['chart' => $chart])->withUsers($users)->withCursos($cursos)->withArticulos($articulos)->withForos($foros)->withUploads($uploads);
    }
    public function getProfile(){
    	$articulos = Articulo::all();
        $cursos = Curso::all();
        $comments = Comment::all();
        $users = User::all();
        $foros = User::all();
    	return view('auth.profile')->withArticulos($articulos)->withComments($comments)->withCursos($cursos)->withUsers($users)->withForos($foros);
    }
    public function getProfiles($id){
        $user = User::find($id);

        return view('auth.profiles')->withUser($user);
    }
    public function inbox(){
        return view('auth.inbox');
    }

    public function edit($id){

        $user = User::find($id);
        return view ('auth.edit')-> withUser($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, ['name' => 'required', 'email' => 'required|email', 'description' => 'required', 'featured_image' => 'sometimes|image', 'facebook' => '', 'twitter' => '', 'github' => '', 'linkedin' => '', 'blogger' => '', 'youtube' => '']);

        $user->name = Purifier::clean($request->input('name'));
        $user->email = Purifier::clean($request->input('email'));
        $user->description = Purifier::clean($request->input('description'));
        $user->facebook = Purifier::clean($request->input('facebook'));
        $user->twitter = Purifier::clean($request->input('twitter'));
        $user->github = Purifier::clean($request->input('github'));
        $user->linkedin = Purifier::clean($request->input('linkedin'));
        $user->website = Purifier::clean($request->input('website'));
        $user->youtube = Purifier::clean($request->input('youtube'));

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('avatars/' . $filename);
            Image::make($image)->resize(128, 128)->save($location);

            $oldFilename = $user->image;
            $user->image = $filename;

            Storage::delete($oldFilename);
        }

        $user->save();

        return redirect()->route('auth.profile');
    }

    public function uplevel(Request $request, $id){
        $user = User::find($id);
    }

    public function downlevel(Request $request, $id){
        $user = User::find($id);
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        Storage::delete($user->image);
        return redirect()->route('auth.dashboard');
    }
}
