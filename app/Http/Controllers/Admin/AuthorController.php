<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuthorRequest;
use App\Model\Admin\AuthorModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    protected $authorModel;
    public function __construct(AuthorModel $authorModel)
    {
        $this->authorModel = $authorModel;
    }

    public function index()
    {
        $author['authors'] = $this->authorModel->index();

        return view('admin.author.index', $author);
    }

    public function create()
    {
        //
    }

    public function store(AuthorRequest $request)
    {
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
