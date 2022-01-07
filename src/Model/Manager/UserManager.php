<?php

namespace Chloe\Admin\Model\Manager;

use Chloe\Admin\Classes\DB;
use Chloe\Admin\Model\User;

class UserManager {

    /**
     * display user
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User {
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = :id");
        $id = intval($id);
        $request->bindParam(":id", $id);
        $request->execute();
        $info = $request->fetch();
        $user = new User();
        if ($info) {
            $user->setId($info['id']);
            $user->setPseudo($info['pseudo']);
            $user->setEmail($info['email']);
            $user->setPassword($info['password']); // We do not display the password
        }
        return $user;
    }

    /**
     * Display a user based on id.
     * @param int $id
     * @return array
     */
    public function getUserID(int $id): array {
        $user = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = :id");
        $request->bindParam(":id", $id);
        if($request->execute()) {
            foreach($request->fetchAll() as $info) {
                $user[] = new User($info['id'], $info['pseudo'], $info['email'], $info['password']);
            }
        }
        return $user;
    }

    /**
     * get a specific email from a user
     * @param string $email
     * @return array
     */
    public function getUserEmail(string $email, string $pseudo): array {
        $user = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE email = :email OR pseudo = :pseudo");
        $request->bindParam(":email", $email);
        $request->bindParam(":pseudo", $pseudo);
        if($request->execute()) {
            foreach($request->fetchAll() as $info) {
                $user[] = new User($info['id'], $info['pseudo'], $info['email'], $info['password']);
            }
        }
        return $user;
    }

    /**
     * Return all users.
     * @return array
     */
    public function getUsers(): array {
        $users = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user");
        $result = $request->execute();
        if($result) {
            foreach($request->fetchAll() as $info) {
                $users[] = new User($info['id'], $info['pseudo'], $info['email'], $info['password']);
            }
        }
        return $users;
    }

    /**
     * add a user
     * @param User $user
     * @return bool
     */
    public function add(User $user): bool {
        $request = DB::getInstance()->prepare("INSERT INTO user (pseudo, email, password) 
                        VALUES (:pseudo, :email, :password)");
        $request->bindValue(':pseudo', $user->getPseudo());
        $request->bindValue(':email', $user->getEmail());
        $request->bindValue(':password', $user->getPassword());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * Modifies the user's personal information.
     * @param User $user
     * @return bool
     */
    public function updateUser(User $user): bool {
        $id = $user->getId();
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE NOT id = :id");
        $request->bindValue(':id', $id);
        $request->execute();

        $user1 = $request->fetchAll();
        $count = count($user1);

        for ($i = 0; $i < $count; $i++) {
            // Checks if the email or nickname entered by the user is not already used
            if ($user1[$i]['email'] === $user->getEmail() || $user1[$i]['pseudo'] === $user->getPseudo()) {
                header("Location: ../index.php?controller=user&action=update&id=$id&error=2");
            }
            else {
                $request = DB::getInstance()->prepare("UPDATE user SET pseudo = :pseudo, email = :email WHERE id = :id");
                $request->bindValue(':id', $user->getId());
                $request->bindValue(':pseudo', $user->setPseudo($user->getPseudo()));
                $request->bindValue(':email', $user->setEmail($user->getEmail()));
            }
        }
        return $request->execute();
    }

    /**
     * Deletes a user but also deletes the article
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool {
        $request = DB::getInstance()->prepare("DELETE FROM article WHERE user_fk = :user_fk");
        $request->bindParam(":user_fk", $id);
        $request->execute();
        $request = DB::getInstance()->prepare("DELETE FROM user WHERE id = :id");
        $request->bindParam(":id", $id);
        return $request->execute();
    }
}