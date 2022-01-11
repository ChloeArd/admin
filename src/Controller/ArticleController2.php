<?php

namespace Chloe\Admin\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Chloe\Admin\form\ArticleType;
use Chloe\Admin\Model\Article;
use Chloe\Admin\Model\Manager\ArticleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController2 extends AbstractController {

    /**
     * @Route("/form/")
     */
    public function new(Request $request)
    {
        $article = new Article();
        $article->setTitle('Hello World');
        $article->setContent('Un très court article.');
        $article->setPicture('https://www.google.com');

        $form = $this->createForm(ArticleType::class, $article);

        return $this->render('::addArticle.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}