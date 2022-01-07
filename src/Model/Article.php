<?php

namespace Chloe\Admin\Model;

class Article {

    private ?int $id;
    private ?string $title;
    private ?string $picture;
    private ?string $content;
    private ?User $user_fk;

    /**
     * @param int|null $id
     * @param string|null $title
     * @param string|null $picture
     * @param string|null $content
     * @param User|null $user_fk
     */
    public function __construct(?int $id = null, ?string $title = null, ?string $picture = null, ?string $content = null, ?User $user_fk = null) {
        $this->id = $id;
        $this->title = $title;
        $this->picture = $picture;
        $this->content = $content;
        $this->user_fk = $user_fk;
    }

    /**
     * @return int|null
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
     * @return string|null
     */
    public function getTitle(): ?string {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): ?string {
        $this->title = $title;
        return $title;
    }

    /**
     * @return string|null
     */
    public function getPicture(): ?string {
        return $this->picture;
    }

    /**
     * @param string|null $picture
     */
    public function setPicture(?string $picture): ?string {
        $this->picture = $picture;
        return $picture;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): ?string {
        $this->content = $content;
        return $content;
    }

    /**
     * @return User|null
     */
    public function getUserFk(): ?User {
        return $this->user_fk;
    }

    /**
     * @param User|null $user_fk
     */
    public function setUserFk(?User $user_fk): ?User {
        $this->user_fk = $user_fk;
        return $user_fk;
    }
}