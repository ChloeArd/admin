<?php

namespace Chloe\Admin\Controller;

use Chloe\Admin\Classes\Controller;
use Chloe\Admin\Model\Article;
use Chloe\Admin\Model\Manager\ArticleManager;
use Chloe\Admin\Model\Manager\UserManager;
use Twig\Error\Error;

class ArticleController extends Controller {

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


    /**
     * add a article
     * @param $fields
     */
    public function add($fields) {
        if (isset($fields['title'], $fields['picture'], $fields['content'])) {

            $title = htmlentities(trim(ucfirst($fields['title'])));
            $picture = htmlentities(trim($fields['picture']));
            $content = htmlentities(trim(ucfirst($fields['content'])));

            if (!filter_var($picture, FILTER_VALIDATE_URL) === false) {
                $manager = new ArticleManager();
                $article = new Article(null, $title, $picture, $content, null);

                header("Location:: ../../?controller=article&action=view&success=0");
                $manager->add($article);
            }
            else {
                header("Location: ../?controller=article&action=add&error=0");
            }
        }

        try {
            $this->render('addArticle.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    /**
     * update a article
     * @return void
     */
    public function update($fields): void {
        $manager = new ArticleManager();

        if (isset($fields['id'], $fields['title'], $fields['picture'], $fields['content'], $fields['user_fk'])) {

            $id = intval($fields['id']);
            $title = htmlentities(ucfirst(trim($fields['title'])));
            $picture = htmlentities(trim($fields['picture']));
            $content = htmlentities(ucfirst(trim($fields['content'])));
            $user_fk = intval($fields['user_fk']);

            if (!filter_var($picture, FILTER_VALIDATE_URL) === false) {
                $userManager = new UserManager();
                $user_fk = $userManager->getUser($user_fk);

                if ($user_fk->getId()) {
                    $article = new Article($id, $title, $picture, $content, $user_fk);

                    $manager->updateArticle($article);

                    header("Location: ../?controller=article&action=view&success=1");
                } else {
                    header("Location: ../?controller=article&action=update&id=$id&error=0");
                }
            }
            else {
                header("Location: ../?controller=article&action=update&id=$id&error=1");
            }
        }

        try {
            $this->render('updateArticle.html.twig', ['article' => $manager->getArticleID($_GET['id'])]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    // apply a user to article
    public function applyUser(): void {
        try {
            $this->render('applyUserArticle.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    /**
     * delete a user
     * @return void
     */
    public function delete(int $id): void {
        if (isset($_POST['id'])) {
            $manager = new ArticleManager();
            $manager->deleteArticle($id);
            header("Location: ../?controller=article&action=view&success=1");
        }

        try {
            $this->render('deleteArticle.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }
}