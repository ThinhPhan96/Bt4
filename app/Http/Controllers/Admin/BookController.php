<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookRequest;
use App\Http\Requests\EditBookRequest;
use App\Model\Admin\AuthorModel;
use App\Model\Admin\BookModel;
use App\Http\Controllers\Controller;
use App\User;

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
        return $book;
    }

    public function show($id)
    {
        $book['authors'] = $this->authorModel->all();
        $book['page'] = $this->bookModel->paginate(PAGE_SIZE)->currentPage();
        $book['books'] = $this->bookModel->getWhere('status', $id);
        return view('admin.book.index', $book);
    }

    public function editBook(EditBookRequest $request)
    {
        $this->bookModel->getUpdate($request->id, $request->name);
        return "success";
    }

    public function destroy($id)
    {
        $book = $this->bookModel->find($id);
        if ($book->status == ONE) {
            return redirect()->route('book.index')->with('error', "Sách đang có người mượn");
        }
        $this->bookModel->getDestroy($id);
        return redirect()->route('book.index')->with('message', "Xóa thành công");
    }
}
