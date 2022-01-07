<?php

namespace Chloe\Admin\Controller;

use Chloe\Admin\Classes\Controller;
use Chloe\Admin\Model\Manager\UserManager;
use Chloe\Admin\Model\User;
use Twig\Error\Error;
use Twig\Error\LoaderError;

class UserController extends Controller {


    public function profile(int $userId): void {
       $manager = new UserManager();

        try {
            $this->render('admin.html.twig', [
                'user' => $manager->getUser($userId),
            ]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function getUsers(): void {
        $manager = new UserManager();

        try {
            $this->render('admin.html.twig', [
                'users' => $manager->getUsers(),
            ]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function add($fields): void {
        if (isset($fields["pseudo"], $fields["email"], $fields["password"])) {
            $userManager = new UserManager();

            $pseudo = htmlentities(trim($fields['pseudo']));
            $email = trim($fields["email"]);
            $password = htmlentities(trim($fields["password"]));

            // I encrypt the password.
            $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);

            $state = $userManager->getUserEmail($email, $pseudo);

            foreach ($state as $user) {
                // Checks if email or pseudo is not use.
                if ($user['email'] === $email || $user['pseudo']) {
                    header("Location: ../../?controller=user&action=add&error=0");
                } // Check if the email address is valid.
                elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $maj = preg_match('@[A-Z]@', $password);
                    $min = preg_match('@[a-z]@', $password);
                    $number = preg_match('@[0-9]@', $password);

                    // Checks if the password contains upper case, lower case, number and at least 8 characters.
                    if ($maj && $min && $number && strlen($password) >= 8) {
                        $user = new User(null, $pseudo, $email, $encryptedPassword);

                        $userManager->add($user);

                        header("Location: ../../?success=0");
                    } else {
                        header("Location: ../../?controller=user&action=add&error=1");
                    }
                } else {
                    header("Location: ../../?controller=user&action=add&error=2");
                }
            }
        }
        try {
            $this->render('addUser.php.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function update($fields, int $idGet): void {
        $userManager = new UserManager();

        if (isset($fields['id'], $fields['pseudo'], $fields['email'])) {

            $id = intval($fields['id']);
            $pseudo = htmlentities(strtoupper(trim($fields['pseudo'])));
            $email = htmlentities(trim($fields['email']));

            // Check if the email is valid.
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user = new User($id, $pseudo, $email);
                $userManager->updateUser($user);
                header("Location: ../?success=0");
            }
            else {
                header("Location: ../?controller=user&action=update&id=" . $idGet . "&error=0");
            }
        }

        try {
            $this->render('updateUser.php.twig', ['user' => $userManager->getUserID($idGet)]);
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }

    public function delete(int $id): void {
        if (isset($_POST['id'])) {
            $manager = new UserManager();
            $manager->deleteUser($id);
        }
        try {
            $this->render('deleteUser.html.twig');
        }
        catch (Error $e) {
            echo $e->getMessage();
        }
    }
}