<?php
class PostController
{
    private $db;
    private $PostManager;

    public function __construct(MongoDB\Database $db)
    {
        $this->db = $db;
        $this->PostManager = new PostManager($this->db->post);
    }

    public function getPosts(): void
    {
        $posts = $this->PostManager->getAllPosts();
        $page = "posts";
        require "views/posts.php";
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
        $response = $this->PostManager->createPost($post);
        if (!$response) {
            $error = "Impossible de créer l'article";
            $page = "createPost";
        } else {
            $info = "Article crée!";
            $page = "posts";
        }
        require "views/default.php";
    }
}
?>
