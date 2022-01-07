<?php

namespace Chloe\Admin\Controller;

use Chloe\Admin\Classes\Controller;
use Chloe\Admin\Model\User;
use Twig\Error\Error;
use Twig\Error\LoaderError;

class UserController extends Controller {


    public function profile(int $userId): void {
        $user = (new User())
            ->setPseudo('ChloeArd')
            ->setEmail('chloe.ardoise@gmail.com')
            ->setPassword('Bonjour123!')
        ;

        try {
            $this->render('admin.html.twig', [
                'user' => $user,
            ]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function getUsers(): void {
        $user = (new User())
            ->setPseudo('ChloeArd')
            ->setEmail('chloe.ardoise@gmail.com')
            ->setPassword('Bonjour123!')
        ;

        try {
            $this->render('admin.html.twig', [
                'user' => $user,
            ]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function add(): void {
        try {
            $this->render('addUser.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function update(): void {
        try {
            $this->render('updateUser.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function delete(): void {
        try {
            $this->render('deleteUser.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }
}