<?php

namespace Chloe\Admin\Model\Manager;

use Chloe\Admin\Classes\DB;
use Chloe\Admin\Model\Article;
use Chloe\Admin\Model\User;

class ArticleManager {

    /**
     * display article
     * @param int $id
     * @return Article
     */
    public function getArticle(int $id): Article {
        $request = DB::getInstance()->prepare("SELECT * FROM article WHERE id = :id");
        $request->bindParam(":id", $id);
        $request->execute();
        $info = $request->fetch();
        $article = new Article();
        if ($info) {
            $article->setId($info['id']);
            $article->setTitle($info['title']);
            $article->setPicture($info['picture']);
            $article->setContent($info['content']);
            $user = new UserManager();
            $article->setUserFk($user->getUser($info['user_fk']));
        }
        return $article;
    }

    /**
     * Display an article based on id.
     * @param int $id
     * @return array
     */
    public function getArticleID(int $id): array {
        $article = [];
        $request = DB::getInstance()->prepare("SELECT * FROM article WHERE id = :id");
        $request->bindParam(":id", $id);
        if($request->execute()) {
            foreach($request->fetchAll() as $info) {
                $article[] = new Article($info['id'], $info['pseudo'], $info['email'], $info['password']);
            }
        }
        return $article;
    }

    /**
     * Return all articles.
     * @return array
     */
    public function getArticles(): array {
        $articles = [];
        $request = DB::getInstance()->prepare("SELECT * FROM article");
        $result = $request->execute();
        if($result) {
            foreach($request->fetchAll() as $info) {
                $userManager = new UserManager();
                $user = $userManager->getUser($info['user_fk']);
                if($user->getId()) {
                    $articles[] = new Article($info['id'], $info['title'], $info['picture'], $info['content'], $user);
                }
            }
        }
        return $articles;
    }

    /**
     * @param Article $article
     * @return bool
     */
    public function add(Article $article): bool {
        $request = DB::getInstance()->prepare("INSERT INTO article (title, picture, content, user_fk) 
                        VALUES (:title, :picture, :content, :user_fk)");
        $request->bindValue(':title', $article->getTitle());
        $request->bindValue(':picture', $article->getPicture());
        $request->bindValue(':content', $article->getContent());
        $request->bindValue(':user_fk', 1);

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * apply a user to article
     * @param Article $article
     * @return bool
     */
    public function applyUserArticle(Article $article): bool {
        $request = DB::getInstance()->prepare("UPDATE article SET user_fk = :user_fk WHERE id = :id");
        $request->bindValue(":user_fk", $article->getUserFk());
        $request->bindValue(":id", $article->getId());
        return $request->execute();
    }

    /**
     * update a article
     * @param Article $article
     * @return bool
     */
    public function updateArticle(Article $article): bool {
        $request = DB::getInstance()->prepare("UPDATE article SET title = :title, picture = :picture, content = :content WHERE id = :id");
        $request->bindValue(':id', $article->getId());
        $request->bindValue(':title', $article->setTitle($article->getTitle()));
        $request->bindValue(':picture', $article->setPicture($article->getPicture()));
        $request->bindValue(':content', $article->setContent($article->getContent()));
        return $request->execute();
    }

    /**
     * Delete a article
     * @param int $id
     * @return bool
     */
    public function deleteArticle(int $id): bool {
        $request = DB::getInstance()->prepare("DELETE FROM article WHERE id = :id");
        $request->bindParam(":id", $id);
        return $request->execute();
    }
}