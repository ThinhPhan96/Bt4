<?php

namespace App\Model\Admin;

use App\Jobs\NewJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BookModel extends Model
{
    use SoftDeletes;

    protected $table = 'books';

    protected $dates = ['deleted_at'];

    public function author()
    {
        return $this->belongsTo('App\Model\Admin\AuthorModel', 'author_id', 'id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsToMany(
            'App\User',
            'book_user',
            'book_id',
            'user_id'
        )
            ->withPivot('status', 'pay')->withTimestamps();
    }

    public function getStore($name, $authorId)
    {
        $book = new BookModel();
        $book->name = $name;
        $book->author_id = $authorId;
        $book->save();
        return $book;
    }

    public function getIndex()
    {
        $book['books'] = $this->with('author', 'user')->paginate(PAGE_SIZE);
        $book['page'] = $this->paginate(PAGE_SIZE)->currentPage();
        $book['authors'] = AuthorModel::all();
        return $book;
    }

    public function getWhere($key, $value)
    {
        return $this->with('author')->where($key, $value)->paginate(PAGE_SIZE);
    }

    public function getTrash()
    {
        $book['books'] = $this->onlyTrashed()->with('author')->paginate(PAGE_SIZE);
        $book['page'] = $this->paginate(PAGE_SIZE)->currentPage();
        $book['users'] = $this->paginate(PAGE_SIZE);
        return $book;
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

    public function errorRestore($id)
    {
        return $this->onlyTrashed()->where('id', $id)->first();
    }

    public function getRestore($id)
    {
        $book = $this->with('author')->onlyTrashed()->find($id);
        $book->restore();
        return $book;
    }

    public function getForceDelete($id)
    {
        $book = $this->with('author')->onlyTrashed()->find($id);
        $book->forceDelete();
        return $book;
    }

    public function statusBook($id, $pay)
    {
        $book = $this->find($id);
        $book->user()->attach(Auth::id(), ['pay' => $pay]);
        $book->status = ONE;
        $book->save();
    }

    public function disBook($id)
    {
        $book = $this->find($id);
        $book->status = TWO;
        $book->save();
        NewJob::dispatch($id)
            ->delay(now()->addMinutes(ONE));
    }
}
