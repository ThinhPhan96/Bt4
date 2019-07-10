<?php

namespace App\Http\Controllers\Admin;

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
        $book['books'] = $this->bookModel::paginate(PAGE_SIZE);
        $book['page'] = $this->authorModel::paginate(PAGE_SIZE)->currentPage();
        $book = Book::with('author')
            $book->author->name
        return view('admin.book.index', $book);
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
        //
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
        //
    }
}
