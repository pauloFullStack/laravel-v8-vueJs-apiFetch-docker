<?php


namespace App\Services;

use App\Repositories\ArticleRepository;
use App\Models\Article;

class ArticleService
{
    /**
     * @var ArticleRepository
     */
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    public function store($request)
    {
        $article = $request->isMethod('put') ? $this->articleRepository->findOrFail($request->article_id) : new Article;

        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save()) {
            return $article;
        }
    }

    public function all()
    {
        return $this->articleRepository->getAllArticles();
    }


    public function show($id)
    {
        return $this->articleRepository->findOrFail($id);
    }

    public function delete($id)
    {
        $article = $this->articleRepository->findOrFail($id);
        if ($article->delete()) {
            return $article;
        }
    }
}
