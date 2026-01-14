<?php

use MongoDB\BSON\ObjectId;

include "./User.php";
include "./Post.php";

class Comment
{
    private string $id;
    private string $content;
    private User $user;
    private string $createdAt;
    private Post $post;

    public function __construct($id, $content, $user, $createdAt, $post)
    {
        $this->id = $id;
        $this->content = $content;
        $this->user = $user;
        $this->createdAt = $createdAt;
        $this->post = $post;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setId(ObjectId $id): void
    {
        $this->id = (string) $id;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method(trim($value));
            }
        }
    }

    public function toArray(): array
    {
        return [
            "content" => $this->content,
            "user" => $this->user,
            "createdAt" => $this->createdAt,
            "post" => $this->post,
        ];
    }
}
?>
