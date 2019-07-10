<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuthorRequest;
use App\Http\Requests\DeleteAuthorRequest;
use App\Model\Admin\AuthorModel;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    protected $authorModel;
    protected $userRepository;

    public function __construct(AuthorModel $authorModel, UserRepository $userRepository)
    {
        $this->authorModel = $authorModel;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $author = $this->authorModel->getIndex();
        return view('admin.author.index', $author);
    }

    public function store(AuthorRequest $request)
    {
        $author = $this->authorModel->getStore($request->name);
        return redirect()->route('author.index')->with('message', "Thêm" . " $author->name thành công");
    }

    public function changeAjaxAuthor(AuthorRequest $request)
    {
        $this->authorModel->getUpdate($request->id, $request->name);
        return "success";
    }

    public function destroyAjaxAuthor(DeleteAuthorRequest $request)
    {
        $id = $request->id;
        $this->authorModel->getDestroy($id);
        return "success";
    }
}