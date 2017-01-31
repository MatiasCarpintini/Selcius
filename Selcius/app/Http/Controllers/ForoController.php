<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Selcius\Http\Requests;
use Selcius\Http\Controllers\Controller;
use Selcius\Foro;
use Selcius\Answer;
use Selcius\User;
use Selcius\Auth;
use Session;
use Purifier;

class ForoController extends Controller
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
        $users = User::all();
        $foros = Foro::orderBy('id', 'desc')->paginate(20);
        return view('foros.index')->withForos($foros)->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('foros.create');
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
            'user_id' => 'required|integer',
            'title' => 'required|min:5',
            'slug' => 'required|max:44',
            'body' => 'required|min:5'
        ]);
        $foro = new Foro;
        $foro->user_id = $request->user_id;
        $foro->title = Purifier::clean($request->title);
        $foro->slug = Purifier::clean($request->slug);
        $foro->body = Purifier::clean($request->body);
        $foro->approved = true;
        $foro->save();

        return redirect()->route('foros.show', $foro->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $foro = Foro::find($slug);
        $users = User::all();
        $foro = Foro::where('slug','=', $slug)->first();
        $answers = Answer::all();
   		return view('foros.show')->withForo($foro)->withUsers($users)->withAnswers($answers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foro = Foro::find($id);
        return view('foros.edit')->withForo($foro);
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
        $foro = Foro::find($id);
        $this->validate($request, [
            'title' => 'required|min:5',
            'slug' => 'required|max:44',
            'body' => 'required|min:5'
        ]);
        $foro = Foro::find($id);
        $foro->title = Purifier::clean($request->input('title'));
        $foro->slug = Purifier::clean($request->input('slug'));
        $foro->body = Purifier::clean($request->input('body'));

        $foro->save();

        return redirect()->route('foros.show', $foro->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foro = Foro::find($id);
        $foro->delete();
        return redirect()->route('foros.index');
    }
}
