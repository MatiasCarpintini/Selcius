<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Selcius\Http\Requests;
use Selcius\Comment;
use Selcius\User;
use Auth;
use Selcius\Articulo;
use Session;
use Purifier;

class CommentsController extends Controller
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
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $articulo_id)
    {
        $this->validate($request, array(
            'comment'   =>  'required'
            ));

        $articulo = Articulo::find($articulo_id);
        $users = User::all();
        $comment = new Comment();
        $comment->comment = Purifier::clean($request->comment);
        $comment->approved = true;
        $comment->articulo()->associate($articulo);
        $comment->user_id = Auth::user()->id;

        $comment->save();

        return response()->json($comment);
    }
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
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
        $comment = Comment::find($id);

        $this->validate($request, array('comment' => 'required'));

        $comment->comment = Purifier::clean($request->input('comment'));

        $comment->save();

        return redirect()->route('articulo.single', $comment->articulo->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $articulo_id = $comment->articulo->id;
        $comment->delete();

        return redirect()->route('articulo.single', $comment->articulo->slug);
    }
}
