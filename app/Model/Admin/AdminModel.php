<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminModel extends Authenticatable
{
    public $table = 'admins';

    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUpdate($id, $name)
    {
        $admin = self::find($id);
        $admin->name = $name;
        $admin->save();
        return $admin;
    }

    public function getIndex()
    {
        $admin['admin'] = self::all();
        return $admin;
    }
}
