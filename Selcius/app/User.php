<?php

namespace Selcius;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;


class User extends Authenticatable 
{
    use Notifiable;
    use Billable;
    protected $table = 'users';
    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    public function articulos(){
        return $this->hasMany('Selcius\Articulo');
    }
    public function comments(){
        return $this->hasMany('Selcius\Comment');
    }
    public function cursos(){
        return $this->hasMany('Selcius\Curso');
    }
    public function likes()
    {
        return $this->hasMany('Selcius\Like');
    }
    public function comentarios(){
        return $this->hasMany('Selcius\Comentario');
    }
    public function messages(){
        return $this->hasMany('Selcius\Message');
    }
    public function foros(){
        return $this->hasMany('Selcius\Foro');
    }
    public function answers(){
        return $this->hasMany('Selcius\Answer');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
