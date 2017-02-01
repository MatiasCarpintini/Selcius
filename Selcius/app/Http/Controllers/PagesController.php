<?php

namespace Selcius\Http\Controllers;

use Selcius\Articulo;
use Selcius\Curso;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Selcius\Http\Requests;
use Selcius\Http\Controllers\Controller;
use Selcius\Section;
use Selcius\Comment;
use Mail;
use Session;
use Auth;
Class PagesController extends Controller {

	public function getIndex()
	{
		$cursos = Curso::orderBy('id','desc')->paginate(1);
		$articulos = Articulo::orderBy('created_at', 'desc')->limit(2)->get();
		$sections = Section::orderBy('id', 'desc')->paginate(1);
		$comments = Comment::all();
		return view ('pages/welcome')->withArticulos($articulos)->withCursos($cursos)->withSections($sections)->withComments($comments);
	}
	public function getNotosotros()
	{
		$first = 'Matias';
		$last = 'Carpintini';
		$fullname = $first . " " . $last;

		$email = 'matiascarpintini@outlook.com';
		$data = [];
		$data['email'] = $email;
		$data['fullname'] = $fullname;

		return view ('pages/nosotros')->withData($data);
	}
	public function getContacto()
	{
		return view ('pages/contact');
	}
	public function postContacto(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10']);

		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message
			);

		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('matiascarpintini@selcius.com');
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Your Email was Sent!');

		return redirect('/');
	}
	public function subscription(Request $request){

        //una clave para identificar al usuario y su medio de pago en stripe
        $token = $request->stripeToken;
        //Registro del pago haciendo uso de la api
        \Auth::user()->subscription('Mensual')->create($token);
        return ('you are subscribed now');
    }
	public function payment(){
        return view('payment');
    }
}
