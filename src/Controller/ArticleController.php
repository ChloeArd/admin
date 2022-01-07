<?php

namespace Chloe\Admin\Controller;

use Chloe\Admin\Model\Article;
use Chloe\Admin\Classes\Controller;
use Chloe\Admin\Model\Manager\ArticleManager;
use Twig\Error\Error;

class ArticleController extends Controller{

    /**
     * display one article
     * @param int $id
     * @return void
     */
    public function getArticle(int $id) {
        $manager = new ArticleManager();

        try {
            $this->render('articleAdmin.html.twig', [
                'article' => $manager->getArticle($id),
            ]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    /**
     * display all articles
     * @return void
     */
    public function getArticles() {
        $manager = new ArticleManager();

        try {
            $this->render('articleAdmin.html.twig', [
                'articles' => $manager->getArticles(),
            ]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function add($fields): void {
        if (isset($fields['title'], $fields['picture'], $fields['content'])) {

            $title = htmlentities(trim(ucfirst($fields['title'])));
            $picture = htmlentities(trim($fields['picture']));
            $content = htmlentities(trim(ucfirst($fields['content'])));

            if (!filter_var($picture, FILTER_VALIDATE_URL) === false) {

            }
        }
        try {
            $this->render('addArticle.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function update(): void {
        try {
            $this->render('updateArticle.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function applyUser(): void {
        try {
            $this->render('applyUserArticle.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function delete(): void {
        try {
            $this->render('deleteArticle.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }
}