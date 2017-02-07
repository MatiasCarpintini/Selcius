<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Selcius\Http\Requests;
use Selcius\Http\Controllers\Controller;
use Selcius\User;
use Selcius\Upload;
use Selcius\Message;
use Auth;
use Session;
use Purifier;
use Storage;

class MensajeController extends Controller
{
    public function __construct(){
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
    public function store(Request $request, $upload_id)
    {
        $this->validate($request, [
            'message' => 'required'
            ]);

        $upload = Upload::find($upload_id);
        $message = new Message();
        $message->message = Purifier::Clean($request->message);
        $message->approved = true;
        $message->upload()->associate($upload);
        $message->user_id = Auth::user()->id;

        $message->save();

        return response()->json($message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $upload_id = $message->upload->id;
        $message->delete();
    }
}
