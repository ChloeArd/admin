<?php

namespace Chloe\Admin\Model;

use DateTime;

class User {

    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;

    /**
     * @param int|null $id
     * @param string|null $pseudo
     * @param string|null $password
     * @param string|null $email
     */
    public function __construct(?int $id = null, ?string $pseudo = null, ?string $email = null, ?string $password = null) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): ?int {
        $this->id = $id;
        return $id;
    }

    /**
     * @return string
     */
    public function getPseudo(): string {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     * @return User
     */
    public function setPseudo(string $pseudo): User {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User {
        $this->email = $email;
        return $this;
    }
}