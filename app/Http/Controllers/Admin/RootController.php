<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuthorRequest;
use App\Model\Admin\AdminModel;
use App\Http\Controllers\Controller;

class RootController extends Controller
{
    protected $adminModel;

    public function __construct(AdminModel $adminModel)
    {
        $this->adminModel = $adminModel;
    }

    public function index()
    {
        $admin['admin'] = $this->adminModel->all();
        return view('admin.account.index', $admin);
    }

    public function editAdmin(AuthorRequest $request)
    {
        $this->adminModel->getUpdate($request->id, $request->name);
        return "success";
    }
}
