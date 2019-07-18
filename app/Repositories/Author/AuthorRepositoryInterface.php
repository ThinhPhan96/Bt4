<?php
namespace App\Repositories\Author;

interface AuthorRepositoryInterface
{
    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getAll();
}
