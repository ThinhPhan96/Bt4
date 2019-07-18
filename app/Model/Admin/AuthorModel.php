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
        $author = new AuthorModel();
        $author->name = $name;
        $author->save();
        return $author;
    }

    public function book()
    {
        return $this->hasMany('App\Model\Admin\BookModel', 'author_id', 'id')->withTrashed();
    }

    public function getUpdate($id, $name)
    {
        $author = $this->find($id);
        $author->name = $name;
        $author->save();
        return $author;
    }

    public function getDestroy($id)
    {
        $author = $this->find($id);
        $author->book;
        foreach ($author->book as $book) {
            $book->delete();
        }
        $author->delete();
        return $author;
    }

    public function getIndex()
    {
        $author['authors'] = $this->onlyTrashed()->with('book')->paginate(PAGE_SIZE);
        $author['page'] = $this->paginate(PAGE_SIZE)->currentPage();
        $author['users'] = $this->paginate(PAGE_SIZE);
        return $author;
    }

    public function getRestore($id)
    {
        $author = $this->with('book')->onlyTrashed()->find($id);
        $author->restore();
        return $author;
    }

    public function getForceDelete($id)
    {
        $author = $this->with('book')->onlyTrashed()->find($id);
        $author->forceDelete();
        return $author;
    }
}
