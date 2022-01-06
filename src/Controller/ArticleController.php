<?php

namespace Chloe\Admin\Controller;

use Chloe\Admin\Model\Article;
use Chloe\Admin\Classes\Controller;
use Twig\Error\Error;

class ArticleController extends Controller{

    public function getArticles(): void {
        $picture = 'https://static.vecteezy.com/packs/media/components/global/search-explore-nav/img/vectors/term-bg-1-666de2d941529c25aa511dc18d727160.jpg';

        $article = (new Article(null, "Article1", $picture, 'bla bla bla', null));

        try {
            $this->render('articleAdmin.html.twig', [
                'article' => $article,
            ]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function add(): void {

        try {
            $this->render('addArticle.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }
}