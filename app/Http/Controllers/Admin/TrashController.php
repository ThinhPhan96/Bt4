<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\AuthorModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrashController extends Controller
{
    protected $authorModel;
    public function __construct(AuthorModel $authorModel)
    {
        $this->authorModel = $authorModel;
    }

    public function index()
    {
        $author = $this->authorModel->getIndex();
        return view('admin.trash.index', $author);
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
