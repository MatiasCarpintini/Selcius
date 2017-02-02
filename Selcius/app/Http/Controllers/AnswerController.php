<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Selcius\Http\Requests;
use Selcius\Answer;
use Selcius\User;
use Auth;
use Selcius\Foro;
use Session;
use Purifier;

class AnswerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $foro_id)
    {
        $this->validate($request, [
            'answer' => 'required'
        ]);
        $answer = new Answer();
        $foro = Foro::find($foro_id);
        $answer->approved = true;
        $answer->foro()->associate($foro);
        $answer->user_id = Auth::user()->id;
        $answer->answer = Purifier::clean($request->answer);

        $answer->save();

        return redirect()->route('foros.show', $answer->foro->slug);
    }
    public function edit($id){
        $answer = Answer::find($id);
        return view('answers.edit')->withAnswer($answer);
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
            'answer' => 'required'
        ]);
        $answer = Answer::find($id);
        $answer->answer = Purifier::clean($request->input('answer'));

        $answer->save();

        return redirect()->route('foros.show', $answer->foro->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::find($id);
        $foro_id = $answer->foro->slug;
        $answer->delete();

        return redirect()->route('foros.show', $foro_id);
    }
}
