<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user['user'] = $this->user->find(Auth::id());
        return view('user.index', $user);
    }

    public function editUser(UserRequest $request)
    {
        $this->user->getUpdate($request->id, $request->name);
        return "success";
    }
}
