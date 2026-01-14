<?php

class PostController
{
    private $db;
    private $postManager;

    public function __construct(MongoDB\Database $db)
    {
        $this->db = $db;
        $this->postManager = new PostManager($this->db->post);
    }

    public function getPosts(): void
    {
        $posts = $this->postManager->findAll();
        $page = "posts";
        require "view/posts.php";
    }

    public function create(): void
    {
        $page = "create";
        require "view/createPost.php";
    }

    public function doCreate(): void
    {
        $data = [
            "title" => $_POST["title"],
            "content" => $_POST["content"],
            "created_at" => new MongoDB\BSON\UTCDateTime(),
            "last_reply_at" => new MongoDB\BSON\UTCDateTime(),
            "username" => $_SESSION["username"],
        ];
        $post = new Post($data);
        $response = $this->postManager->createPost($post);
        if (!$response) {
            $error = "Impossible de créer l'article";
            $page = "createPost";
        } else {
            $info = "Article crée!";
            $page = "posts";
        }
        require "views/default.php";
    }

    public function doDelete(): void
    {
        $id = $_POST["id"];
        $post = $this->postManager->findById($id);
        if (
            isset($_SESSION["username"]) &&
            $_SESSION["username"] === $post->getUsername()
        ) {
            $response = $this->postManager->delete($id);
            if (!$response) {
                $error = "Impossible de supprimer l'article";
            } else {
                $info = "Article supprimé!";
            }
        }
        $page = "profile";
        require "views/default.php";
    }

    public function update(): void
    {
        $page = "updatePost";
        require "view/updatePost.php";
    }

    public function doUpdate(): void
    {
        if (!isset($_GET["id"])) {
            $error = "Id manquant.";
            $page = "profile";
        } else {
            $post = $this->postManager->findById($_GET["id"]);
            $post->setTitle($_POST["title"]);
            $post->setContent($_POST["content"]);
            $response = $this->postManager->update($post);
            if (!$response) {
                $error = "Impossible de créer l'article";
                $page = "createPost";
            } else {
                $info = "Article crée!";
                $page = "posts";
            }
        }
        require "views/default.php";
    }
}
?>
