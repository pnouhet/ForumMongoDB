<?php
class CommentController
{
    private $db;
    private $CommentManager;

    public function __construct(MongoDB\Database $db)
    {
        $this->db = $db;
        $this->CommentManager = new CommentManager($this->db->comment);
    }
    public function reply(): void
    {
        if (isset($_GET["id"])) {
            $postId = $_GET["id"];
            $parentId = $_GET["parentId"] ?? null;
            $page = "replyPost";
        } else {
            $error = "Id manquant.";
            $page = "posts";
        }
        require "view/default.php";
    }

    public function doReply(): void
    {
        if (
            isset($_POST["postId"]) &&
            isset($_POST["content"]) &&
            isset($_SESSION["user"])
        ) {
            $data = [
                "content" => $_POST["content"],
                "createdAt" => date("d/m/Y H:i:s"),
                "userId" => $_SESSION["user"]->getId(),
                "username" => $_SESSION["user"]->getUsername(),
                "postId" => $_POST["postId"],
                "parentId" => $_POST["parentId"] ?? null,
            ];
            $comment = new Comment($data);
            $this->CommentManager->create($comment);

            header(
                "Location: index.php?ctrl=post&action=findOne&id=" .
                    $_POST["postId"],
            );
            exit();
        } else {
            $error = "Impossible de répondre.";
            $page = "posts";
            require "view/default.php";
        }
    }
}
