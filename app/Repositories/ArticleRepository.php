<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Article;

class ArticleRepository extends BaseRepository
{

    public function model()
    {
        return Article::class;
    }

    public function getAllArticles($perPage = 5)
    {
        $query = $this->makeModel()->newQuery();
        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
