<?php

namespace App\Http\Controllers;

use App\Model\Admin\BookModel;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowController extends Controller
{
    protected $user;
    protected $bookModel;

    public function __construct(BookModel $bookModel, User $user)
    {
        $this->bookModel = $bookModel;
        $this->user = $user;
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
        $book['book'] = $this->bookModel->with('author')->find($id);
        return view('borrow.show', $book);
    }

    public function edit($id)
    {
        $book['book'] = $this->bookModel->find($id);
        return view('borrow.edit', $book);
    }

    public function update(Request $request, $id)
    {
        $book = $this->bookModel->find($id);
        if (Carbon::now('Asia/Ho_Chi_Minh') > $request->pay) {
            return redirect()->route('borrow.edit', $id)->with('error', "Ngày trả phải lớn hơn ngày mượn");
        }
        if (Carbon::now('Asia/Ho_Chi_Minh')->day > $request->pay) {
            return redirect()->route('borrow.edit', $id)->with('error', "Ngày trả phải lớn hơn ngày mượn");
        }
        $td = Carbon::create($request->pay);
            $today = Carbon::today();
            $day = $td->diffInDays($today);
        if ($day > 4) {
            return redirect()->route('borrow.edit', $id)->with('error', "Ngày trả không quá 4 ngày");
        }
        if ($book->status == 1) {
            return redirect()->route('borrow.edit', $id)->with('error', "Sách đã có người mượn");
        }

        $this->bookModel->statusBook($id, $request->pay);
        return redirect()->route('borrow.index')->with('message', "Mượn thành công");
    }

    public function destroy($id)
    {
        //
    }
}
