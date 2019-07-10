<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuthorModel extends Model
{
    use SoftDeletes;

    protected $table = 'authors';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
    ];

    public function getStore($name)
    {
        $author = new self();
        $author->name = $name;
        $author->save();
        return $author;
    }

    public function book()
    {
        return $this->hasMany('App\Model\BookModel', 'author_id', 'id');
    }

    public function getUpdate($id, $name)
    {
        $author = self::find($id);
        $author->name = $name;
        $author->save();
        return $author;
    }

    public function getDestroy($id)
    {
        $author = self::find($id);
        $author->delete();
        return $author;
    }

    public function getIndex()
    {
        $author['authors'] = self::onlyTrashed()->paginate(PAGE_SIZE);
        $author['page'] = self::paginate(PAGE_SIZE)->currentPage();
        $author['user'] = self::all();
        return $author;
    }

}
