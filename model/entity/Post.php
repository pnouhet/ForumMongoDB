<?php

class Post
{
    private string $id;
    private string $title;
    private string $content;
    private string $createdAt;
    private string $lastReplyAt;
    private string $username;

    public function __construct(array $data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    public function getId(): string
    {
      return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getLastReplyAt(): string
    {
        return $this->lastReplyAt;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setLastReplyAt(string $lastReplyAt): void
    {
        $this->lastReplyAt = $lastReplyAt;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function hydrate(array $donnees): void
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
            "title" => $this->title,
            "content" => $this->content,
            "createdAt" => $this->createdAt,
            "lastReplyAt" => $this->lastReplyAt,
            "username" => $this->username,
        ];
    }
}
