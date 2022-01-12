<?php

namespace Chloe\Admin\Model;

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
    public function getId(): ?int {
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
    public function getPseudo(): ?string {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     * @return User
     */
    public function setPseudo(string $pseudo): ?string {
        $this->pseudo = $pseudo;
        return $pseudo;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): ?string {
        $this->password = $password;
        return $password;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): ?string {
        $this->email = $email;
        return $email;
    }
}