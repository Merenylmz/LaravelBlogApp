<?php

namespace App\Repository;
use App\Interfaces\IBlogRepository;
use App\Models\Blog;

class BlogRepository implements IBlogRepository
{
    use Common\CommonRepositoryTrait;

    private $blog;
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
        $this->model = $this->blog;
    }
}
