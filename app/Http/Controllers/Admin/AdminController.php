<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\AdminModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->only('index');
    }

    //Phương thức trả về view khi đăng nhập admin thành công
    public function index()
    {
        return view('admin.dashboard');
    }

//    //Phương thức trả về view dùng để đăng ký tài khoản admin
//    public function create()
//    {
//        //return view('admin.auth.register');
//        return view('admin.auth.register');
//    }
//
//    public function store(Request $request)
//    {
//        //validate dữ liệu được gửi từ form đi
//        $this->validate($request, array(
//            'name' => 'required',
//            'email' => 'required',
//            'password' => 'required',
//        ));
//
//        //khởi tạo model để lưu admin mới
//        $adminModel = new AdminModel();
//        $adminModel->name = $request->name;
//        $adminModel->email = $request->email;
//        $adminModel->password = bcrypt($request->password);
//        $adminModel->save();
//
//
//        return redirect()->route('admin.auth.login');
//    }
}
