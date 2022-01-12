<?php

namespace Chloe\Admin\Controller;

use Chloe\Admin\Controller\Traits\ReturnViewTrait;
use Chloe\Admin\Model\Article;
use Chloe\Admin\Model\Manager\ArticleManager;
use Chloe\Admin\Model\Manager\UserManager;

class ArticleController2  {

    use ReturnViewTrait;

    /**
     * add a article
     * @param $fields
     */
    public function add($fields) {
        if (isset($fields['title'], $fields['picture'], $fields['content'])) {
            header("Location: ../?roifriofn=1");

            $title = htmlentities(trim(ucfirst($fields['title'])));
            $picture = htmlentities(trim($fields['picture']));
            $content = htmlentities(trim(ucfirst($fields['content'])));

            if (!filter_var($picture, FILTER_VALIDATE_URL) === false) {
                $manager = new ArticleManager();
                $article = new Article(null, $title, $picture, $content, null);

                $manager->add($article);
                header("Location: ../?controller=article&action=view&success=0");
            }
            else {
                header("Location: ../?controller=article&action=add&error=0");
            }
        }
        $this->return('addArticleView', "Ajouter un article");
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
        $this->return('updateArticleView', "Modifier un article");
    }

    /**
     * delete a user
     * @return void
     */
    public function delete(int $id): void {
        if (isset($_POST['id'])) {
            $manager = new ArticleManager();
            $manager->deleteArticle($id);
        }
        $this->return('deleteArticleView', "Supprimer un article");
    }
}