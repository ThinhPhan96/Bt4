<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\BookModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrashBookController extends Controller
{
    protected $bookModel;
    public function __construct(BookModel $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book['books'] = $this->bookModel->with('author')->onlyTrashed()->paginate(PAGE_SIZE);
        $book['page'] = $this->bookModel->paginate(PAGE_SIZE)->currentPage();
        $book['users'] = $this->bookModel->paginate(PAGE_SIZE);
        return view('admin.trash.book', $book);
    }

    public function restore($id)
    {
        $this->bookModel->getRestore($id);
        return redirect()->route('trashbook.index')->with('message', "Khôi phục sach thành công");
    }

    public function forceDelete($id)
    {
        $this->bookModel->getForceDelete($id);
        return redirect()->route('trashbook.index')->with('message', "Xóa sach thành công");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
