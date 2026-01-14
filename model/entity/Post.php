<?php
include("./User.php");

class Post
{
  private string $id;
  private string $title;
  private string $content;
  private string $date;
  private User $user;

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

  public function getUser(): User
  {
    return $this->user;
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

  public function setUser(User $user)
  {
    $this->user = $user;
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
