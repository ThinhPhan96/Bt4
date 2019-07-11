<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookRequest;
use App\Model\Admin\AuthorModel;
use App\Model\Admin\BookModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    protected $bookModel;
    protected $authorModel;

    public function __construct(BookModel $bookModel, AuthorModel $authorModel)
    {
        $this->bookModel = $bookModel;
        $this->authorModel = $authorModel;
    }

    public function index()
    {
        $book = $this->bookModel->getIndex();
        return view('admin.book.index', $book);
    }

    public function store(BookRequest $request)
    {
        $book = $this->bookModel->getStore($request->name, $request->author_id);
        return redirect()->route('book.index')->with('message', "Thêm" . " $book->name thành công");
    }

    public function show($id)
    {
        $book['authors'] = $this->authorModel->all();
        $book['page'] = $this->bookModel->getPage();
        $book['books'] = $this->bookModel->getWhere('status', $id);
        return view('admin.book.index', $book);
    }

    public function editBook(BookRequest $request)
    {
        $this->bookModel->getUpdate($request->id, $request->name);
        return "success";
    }

    public function destroy($id)
    {
        $this->bookModel->getDestroy($id);
        return redirect()->route('book.index')->with('message', "Xóa thành công");
    }
}
