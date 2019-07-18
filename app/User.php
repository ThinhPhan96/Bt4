<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUpdate($id, $name)
    {
        $user = $this->find($id);
        $user->name = $name;
        $user->save();
        return $user;
    }

    public function books()
    {
        return $this->belongsToMany(
            'App\Model\Admin\BookModel',
            'book_user',
            'user_id',
            'book_id'
        )
            ->withPivot('status', 'pay')->withTimestamps();
    }

    public function checkBook()
    {
        $user = $this->with('books')->find(Auth::id());
    }
}
