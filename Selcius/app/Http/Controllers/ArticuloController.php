<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Selcius\Http\Requests;
use Selcius\Http\Controllers\Controller;
use Selcius\Articulo;
use Selcius\Tag;
use Selcius\Category;
use Selcius\User;
use Auth;
use Session;
use Purifier;
use Image;
use Storage;

Class ArticuloController extends Controller {
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
        $articulos = Articulo::orderBy('id', 'desc')->paginate();
        return view ('articulos.index')-> withArticulos($articulos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags =  Tag::all();
        return view('articulos.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $this->validate($request, array('title' => 'required|max:255',
        'slug' => 'required|alpha_dash|min:5|max:255|unique:articulos,slug','category_id' => 'required|integer',  'body' => 'required',
        'featured_image' => 'sometimes|image'));

        $articulo = new Articulo;   
        $user = User::find($user_id);
        $articulo->title = $request->title;
        $articulo->user()->associate($user);
        $articulo->slug = $request->slug;
        $articulo->category_id = $request->category_id;
        $articulo->body = Purifier::clean($request->body);

        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $articulo->image = $filename;
        }

        $articulo->save();

        $articulo->tags()->sync($request->tags, false);

        return redirect()->route('articulos.show', $articulo->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo = Articulo::find($id);
        return view ('articulos.show')->withArticulo($articulo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $articulo = Articulo::find($id);
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }
        $tags = Tag::all();
        $tags2 = [];
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        return view('articulos.edit')-> withArticulo($articulo)->withCategories($cats)->withTags($tags2);
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
        $articulo = Articulo::find($id);
        if ($request->input('slug') == $articulo->slug) {
            $this->validate($request, array(
                'title' => 'required|max:255',
                'category_id' => 'required|integer',
                'featured_image' => 'sometimes|image',
                'body'  => 'required'
            ));
        } else {
        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug'  => 'required|alpha_dash|min:5|max:255|unique:aticulos,slug',
                'category_id' => 'required|integer',
                'featured_image' => 'sometimes|image',
                'body'  => 'required'
            ));
        }
        $articulo->title = $request->input('title');
        $articulo->slug = $request->input('slug');
        $articulo->category_id = $request->input('category_id');
        $articulo->body = Purifier::clean($request->input('body'));

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $oldFilename = $articulo->image;
            $articulo->image = $filename;

            Storage::delete($oldFilename);
        }

        $articulo->save();

        if (isset($request->tags))
        {
            $articulo->tags()->sync($request->tags);
        }
        else
        {
            $articulo->tags()->sync([]);
        }

        return redirect()-> route('articulos.show', $articulo->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->tags()->detach();
        Storage::delete($articulo->image);
        $articulo->delete();
        return redirect()->route('articulo.index');
    }
}
