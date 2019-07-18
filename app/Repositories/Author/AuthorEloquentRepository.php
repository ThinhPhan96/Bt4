<?php
namespace App\Repositories\Author;

use App\Model\Admin\AuthorModel;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Carbon;

class AuthorEloquentRepository extends EloquentRepository implements AuthorRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Model\Admin\AuthorModel::class;
    }

    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getAll()
    {
        $author['author'] = AuthorModel::all();
        return $author;
    }

}
