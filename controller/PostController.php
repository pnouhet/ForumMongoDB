<?php

class PostController
{
    private $db;
    private $postManager;
    private $commentManager;

    public function __construct(MongoDB\Database $db)
    {
        $this->db = $db;
        $this->postManager = new PostManager($this->db->post);
        $this->commentManager = new CommentManager($this->db->comment);
    }

    public function posts(): void
    {
        $posts = $this->postManager->findAll();
        $page = "posts";
        require "view/default.php";
    }

    public function create(): void
    {
        $page = "createPost";
        require "view/default.php";
    }

    public function doCreate(): void
    {
        $data = [
            "title" => $_POST["title"],
            "content" => $_POST["content"],
            "createdAt" => date("d/m/Y H:i:s"),
            "lastReplyAt" => date("d/m/Y H:i:s"),
            "username" => $_SESSION["user"]->getUsername(),
        ];
        $post = new Post($data);
        $response = $this->postManager->create($post);
        if (!$response) {
            $error = "Impossible de créer l'article";
            $page = "createPost";
        } else {
            $info = "Article crée!";
            $page = "singlePost";
            $post = $this->postManager->findById($response);
            $comments = $this->commentManager->findByPostId($response);
        }
        require "view/default.php";
    }

    public function doDelete(): void
    {
        $id = $_GET["id"];
        $post = $this->postManager->findById($id);
        if (
            isset($_SESSION["user"]) &&
            $_SESSION["user"]->getUsername() === $post->getUsername()
        ) {
            $response = $this->postManager->delete($id);
            if (!$response) {
                $error = "Impossible de supprimer l'article";
            } else {
                $info = "Article supprimé!";
            }
        }
        $page = "posts";
        $posts = $this->postManager->findAll();
        require "view/default.php";
    }

    public function update(): void
    {
        if (isset($_GET["id"])) {
            $post = $this->postManager->findById($_GET["id"]);
            $page = "updatePost";
        } else {
            $error = "Id manquant.";
            $page = "profile";
        }
        require "view/default.php";
    }

    public function doUpdate(): void
    {
        if (!isset($_GET["id"])) {
            $error = "Id manquant.";
            $page = "profile";
        } else {
            $post = $this->postManager->findById($_GET["id"]);
            if (
                isset($_SESSION["user"]) &&
                $_SESSION["user"]->getUsername() === $post->getUsername()
            ) {
                $post->setTitle($_POST["title"]);
                $post->setContent($_POST["content"]);
                $response = $this->postManager->update($post);
                if (!$response) {
                    $error = "Impossible de modifier l'article";
                    $page = "updatePost";
                } else {
                    $info = "Article modifié !";
                    $page = "posts";
                    $posts = $this->postManager->findAll();
                }
            }
        }
        require "view/default.php";
    }

    public function findOne(): void
    {
        if (isset($_GET["id"])) {
            $post = $this->postManager->findById($_GET["id"]);
            $comments = $this->commentManager->findByPostId($_GET["id"]);
            $page = "singlePost";
        } else {
            $error = "Id manquant.";
            $page = "posts";
            $posts = $this->postManager->findAll();
        }
        require "view/default.php";
    }
}
?>
