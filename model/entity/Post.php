<?php

class Post
{
    private string $id;
    private string $title;
    private string $content;
    private string $created_at;
    private string $last_reply_at;
    private string $username;

    public function __construct(array $data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    public function getId()
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
        return $this->created_at;
    }

    public function getLastReplyAt(): string
    {
        return $this->last_reply_at;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }

    public function setLastReplyAt(string $last_reply_at)
    {
        $this->last_reply_at = $last_reply_at;
    }

    public function setUser(string $username)
    {
        $this->username = $username;
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
            "title" => $this->title,
            "content" => $this->content,
            "date" => $this->date,
            "user" => $this->user,
        ];
    }
}
