<?php

require '../vendor/autoload.php';
require '../Config/Config.php';

use Chloe\Admin\Controller\ArticleController;
use Chloe\Admin\Controller\ArticleController2;
use Chloe\Admin\Controller\UserController;

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'user':
            $controller = new UserController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add' :
                        $controller->add($_POST);
                        break;
                    case 'update':
                        $controller->update($_POST, $_GET['id']);
                        break;
                    case 'delete':
                        $controller->delete($_GET['id']);
                        break;
                }
            }
            break;
        case 'article':
            $controller = new ArticleController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'view':
                        $controller->getArticles();
                        break;
                    case 'add' :
                        $controller->add($_POST);
                        break;
                    case 'update':
                        $controller->update($_POST);
                        break;
                    case 'delete':
                        $controller->delete($_GET['id']);
                        break;
                    case 'applyUser':
                        $controller->applyUser($_POST);
                        break;
                }
            }
            break;
    }
}
else {
    $controller = new UserController();
    $controller->getUsers();
}
