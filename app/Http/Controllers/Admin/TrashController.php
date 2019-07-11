<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\AuthorModel;
use App\Model\Admin\BookModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrashController extends Controller
{
    protected $authorModel;
    protected $bookModel;
    public function __construct(AuthorModel $authorModel, BookModel $bookModel)
    {
        $this->authorModel = $authorModel;
        $this->bookModel = $bookModel;
    }

    public function index()
    {
        $author = $this->authorModel->getIndex();
        return view('admin.trash.index', $author);
    }

    public function restore($id)
    {
        $this->authorModel->getRestore($id);
        return redirect()->route('trash.index')->with('message', "Khôi phục tác giả thành công");
    }

    public function forceDelete($id)
    {
        $this->authorModel->getForceDelete($id);
        return redirect()->route('trash.index')->with('message', "Xóa tác giả thành công");
    }

}
