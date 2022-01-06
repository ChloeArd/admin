<?php

require '../vendor/autoload.php';
require '../Config/Config.php';

use Chloe\Admin\Controller\ArticleController;
use Chloe\Admin\Controller\UserController;


$id = 1;

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'user':
            $controller = new UserController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add' :
                        $controller->add();
                        break;
                    case 'edit':
                        break;
                    case 'delete':
                        break;
                }
            }
        case 'article':
            $controller = new ArticleController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'view':
                        $controller->getArticles();
                        break;
                    case 'add' :
                        $controller->add();
                        break;
                    case 'edit':
                        break;
                    case 'delete':
                        break;
                    case 'applyUser':
                        break;
                }
            }
    }
}
else {
    $controller = new UserController();
    $controller->getUsers();
}
