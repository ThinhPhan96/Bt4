<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookModel extends Model
{
    use SoftDeletes;

    protected $table = 'books';

    protected $dates = ['deleted_at'];

    public function author()
    {
        return $this->belongsTo('App\Model\Admin\AuthorModel','author_id','id');
    }

    public function getStore($name,$authorId)
    {
        $book = new $this();
        $book->name = $name;
        $book->author_id = $authorId;
        $book->save();
        return $book;
    }

    public function getIndex()
    {
        $book['books'] = $this->with('author')->paginate(PAGE_SIZE);
        $book['page'] = $this->paginate(PAGE_SIZE)->currentPage();
        $book['authors'] = AuthorModel::all();
        return $book;
    }

    public function getWhere($key, $value)
    {
        return self::with('author')->where($key, $value)->paginate(PAGE_SIZE);
    }

    public function getAuthor()
    {
        return self::with('author')->get();
    }

    public function getPage()
    {
        return self::paginate(PAGE_SIZE)->currentPage();
    }

    public function getUpdate($id, $name)
    {
        $book = $this->find($id);
        $book->name = $name;
        $book->save();
        return $book;
    }

    public function getDestroy($id)
    {
        $book = $this->find($id);
        $book->delete();
        return $book;
    }

    public function getRestore($id)
    {
        $author = $this->with('author')->onlyTrashed()->find($id);
        $author->restore();
        return $author;
    }

    public function getForceDelete($id)
    {
        $author = $this->with('author')->onlyTrashed()->find($id);
        $author->forceDelete();
        return $author;
    }
}
