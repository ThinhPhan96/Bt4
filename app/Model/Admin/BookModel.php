<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table = 'books';

    public function author()
    {
        return $this->belongsTo('App\Model\Admin\AuthorModel');
    }
}
