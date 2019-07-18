<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuthorRequest;
use App\Model\Admin\AuthorModel;
use App\Model\Admin\BookModel;
use App\Repositories\Author\AuthorEloquentRepository;
use App\Repositories\Author\AuthorRepositoryInterface;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    protected $authorModel;
    protected $authorRepositoryInterface;
    protected $bookModel;

    public function __construct(AuthorModel $authorModel, AuthorRepositoryInterface $author, BookModel $bookModel)
    {
        $this->authorModel = $authorModel;
        $this->authorRepositoryInterface = $author;
        $this->bookModel = $bookModel;
    }

    public function index()
    {
        $author = $this->authorModel->getIndex();
        return view('admin.author.index', $author);
    }

    public function store(AuthorRequest $request)
    {
        $author = $this->authorModel->getStore($request->name);
        return $author;
    }

    public function destroy($id)
    {
        $author = $this->authorModel->find($id);
        foreach ($author->book as $value) {
            if ($value->status == ONE) {
                return redirect()->route('author.index')->with('error', "Sách của tác giả đang được mượn");
            }
            break;
        }

        $this->authorModel->getDestroy($id);
        return redirect()->route('author.index')->with('message', "Xóa thành công");
    }
    public function show()
    {

    }

    public function changeAjaxAuthor(AuthorRequest $request)
    {
        $this->authorModel->getUpdate($request->id, $request->name);
        return "success";
    }

    public function res()
    {
        $author = $this->authorRepositoryInterface->getAll();
        dd($author);
        return view('admin.author.res', $author);
    }
}
