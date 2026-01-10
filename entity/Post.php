<?php
include("./User.php");

class Post
{
  private string $id;
  private string $title;
  private string $content;
  private string $date;
  private string $username;

  public function __construct(array $data = null)
  {
    if ($data)
      $this->hydrate($data);
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

  public function getDate(): string
  {
    return $this->date;
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

  public function setDate(string $date)
  {
    $this->date = $date;
  }

  public function setUser(string $username)
  {
    $this->username = $username;
  }

  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value) {
      $method = 'set' . ucfirst($key);
      if (method_exists($this, $method)) {
        $this->$method(trim($value));
      }
    }
  }
}
