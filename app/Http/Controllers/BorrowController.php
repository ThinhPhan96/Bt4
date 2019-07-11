<?php

namespace App\Http\Controllers;

use App\Model\Admin\BookModel;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    protected $bookModel;
    public function __construct(BookModel $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function index()
    {
        $book = $this->bookModel->getIndex();
        return view('borrow.index', $book);
    }

    public function create()
    {

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
