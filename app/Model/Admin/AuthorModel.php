<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthorModel extends Model
{
    protected $table = 'authors';

    protected $fillable = [
        'name'
    ];

    public function index()
    {
        $author = DB::table('authors')->paginate(3);
        return $author;
    }

    public static function store($name)
    {
    }
}
