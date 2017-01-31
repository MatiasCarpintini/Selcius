<?php

namespace Selcius\Http\Controllers;

use Illuminate\Http\Request;
use Selcius\Http\Requests;
use Selcius\Like;
use Selcius\User;
use Auth;
use Selcius\Curso;
use Session;

class LikeController extends Controller
{
    public function store(Request $request)
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
