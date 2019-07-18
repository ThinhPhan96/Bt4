<?php

namespace App\Http\Controllers;

use App\Model\Admin\BookModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
{
    protected $bookModel;
    protected $user;

    public function __construct(BookModel $bookModel, User $user)
    {
        $this->bookModel = $bookModel;
        $this->user = $user;
    }

    public function index()
    {
        $book['book'] = $this->user->find(Auth::id());
        return view('pay.index', $book);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $user = $this->user->find(Auth::id());
        $book = $this->bookModel->find($id);
        $book->status = ZERO;
        $book->save();
        $user->books()->detach($book, ['status' => ONE]);
        return redirect()->route('pay.index')->with('message', "Trả thành công");
    }
}
