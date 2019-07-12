<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\BookModel;
use App\Http\Controllers\Controller;

class TrashBookController extends Controller
{
    protected $bookModel;
    public function __construct(BookModel $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function index()
    {
        $book = $this->bookModel->getTrash();
        return view('admin.trash.book', $book);
    }

    public function restore($id)
    {
        $book = $this->bookModel->errorRestore($id);
        $author = $book->author;
        if ($author->trashed()) {
            return redirect()->route('trashbook.index')->with('error', "Tác giả đã bị xóa");
        }
        $this->bookModel->getRestore($id);
        return redirect()->route('trashbook.index')->with('message', "Khôi phục sach thành công");
    }

    public function forceDelete($id)
    {
        $this->bookModel->getForceDelete($id);
        return redirect()->route('trashbook.index')->with('message', "Xóa sach thành công");
    }
}
