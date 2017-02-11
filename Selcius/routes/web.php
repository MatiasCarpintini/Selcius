<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
    Route::get('/', function () {
        return view('pages.welcome');
    });
	Auth::routes();
	Route::get('/profile', ['uses'=> 'UserController@getProfile', 'as' => 'auth.profile']);
	Route::get('profile/{id}/edit', ['uses' => 'UserController@edit', 'as' => 'auth.edit']);
	Route::put('profile/{id}', ['uses' => 'UserController@update', 'as' => 'auth.update']);
	Route::get('/dashboard', 'UserController@dashboard');
	Route::get('/profiles/{id}', ['uses' => 'UserController@getProfiles', 'as' => 'auth.profiles']);

	Route::resource('foros', 'ForoController');
	Route::resource('categories', 'CategoryContoller', ['except' => ['create']]);

	Route::resource('sections', 'SeccionController');

	Route::post('/create', ['uses' => 'SeccionController@update', 'as' => 'create']);

	Route::post('comentarios/{curso_id}', ['uses' => 'ComentarioController@store', 'as' => 'comentarios.store']);
	Route::get('comentarios/{id}/edit', ['uses' => 'ComentarioController@edit', 'as' => 'comentarios.edit']);
	Route::get('comentarios/index', 'ComentarioController@index');
	Route::put('comentarios/{id}', ['uses' => 'ComentarioController@update', 'as' => 'comentarios.update']);
	Route::delete('comentarios/{id}', ['uses' => 'ComentarioController@destroy', 'as' => 'comentarios.destroy']);
	Route::get('comentarios/{id}/delete', ['uses' => 'ComentarioController@delete', 'as' => 'comentarios.delete']);

	Route::post('answers/{foro_id}', ['uses' => 'AnswerController@store', 'as' => 'answers.store']);
	Route::get('answers/{id}/edit', ['uses' => 'AnswerController@edit', 'as' => 'answers.edit']);
	Route::get('answers/index', 'AnswerController@index');
	Route::put('answers/{id}', ['uses' => 'AnswerController@update', 'as' => 'answers.update']);
	Route::delete('answers/{id}', ['uses' => 'AnswerController@destroy', 'as' => 'answers.destroy']);
	Route::get('answers/{id}/delete', ['uses' => 'AnswerController@delete', 'as' => 'answers.delete']);

	Route::post('messages/{upload_id}', ['uses' => 'MensajeController@store', 'as' => 'messages.store']);

	Route::resource('cursos', 'CursoController');

	Route::resource('class', 'UploadController');

	Route::resource('tags', 'TagController', ['except' => ['create']]);

	Route::get('courses/{slug}', ['as' => 'courses.single', 'uses' => 'CourseController@getSingle'])-> where ('slug', '[\w\d\-\_]+');
	Route::get('courses',array('uses' => 'CourseController@getIndex', 'as' => 'courses.index'));

	Route::get('articles/{slug}', ['as' => 'articulo.single', 'uses' => 'SelciusController@getSingle'])-> where ('slug', '[\w\d\-\_]+');
	Route::get('articles',array('uses' => 'SelciusController@getIndex', 'as' => 'articulo.index'));

	Route::get('/', 'PagesController@getIndex');

	Route::resource('articulos','ArticuloController');

	Route::post('comments/{articulo_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
	Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
	Route::get('comments/index', 'CommentsController@index');
	Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
	Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
	Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

Route::post('/', function(){
	$token = Input::get('stripeToken');

		Auth::user()->subscription('Mensual')->create($token);

		return ('Ok');
});

Route::post('/', function(){
	$token = Input::get('stripeToken');

		Auth::user()->subscription('Anual')->create($token);

		return ('Ok');
	});
