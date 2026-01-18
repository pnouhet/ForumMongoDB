<?php
class CommentController
{
    private $db;
    private $commentManager;
    private $postManager;

    public function __construct(MongoDB\Database $db)
    {
        $this->db = $db;
        $this->postManager = new PostManager($db->post);
        $this->commentManager = new CommentManager($this->db->comment);
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
            $response = $this->commentManager->create($comment);

            $this->postManager->gotReplied($_POST["postId"]);
            header(
                "Location: index.php?ctrl=post&action=findOne&id=" .
                    $_POST["postId"],
            );
            exit();
        } else {
            $error = "Impossible de répondre.";
            $page = "singlePost";
            $post = $this->postManager->findById($_POST["postId"]);
            $comments = $this->commentManager->findByPostId($_POST["postId"]);
            require "view/default.php";
        }
    }

    public function update(): void
    {
        if (!isset($_GET["id"])) {
            $error = "Id manquant.";
            $page = "profile";
        } else {
            $parentId = $_GET["parentId"] ?? null;
            $comment = $this->commentManager->findById($_GET["id"]);
            $page = "updateComment";
        }
        require "view/default.php";
    }

    public function doUpdate(): void
    {
        if (!isset($_GET["id"])) {
            $error = "Id manquant.";
            $page = "profile";
        } else {
            $comment = $this->commentManager->findById($_GET["id"]);
            if (
                isset($_SESSION["user"]) &&
                $_SESSION["user"]->getUsername() === $comment->getUsername()
            ) {
                $comment->setContent($_POST["content"]);
                $response = $this->commentManager->update($comment);
                if (!$response) {
                    $error = "Impossible de modifier la réponse";
                    header(
                        "Location: index.php?ctrl=post&action=findOne&id=" .
                            $comment->getPostId(),
                    );
                } else {
                    $info = "Réponse modifié !";
                    $page = "singlePost";
                    $post = $this->postManager->findById($comment->getPostId());
                    $comments = $this->commentManager->findByPostId(
                        $comment->getPostId(),
                    );
                }
            }
        }
        require "view/default.php";
    }

    public function doDelete(): void
    {
        if (!isset($_GET["id"])) {
            $error = "Id manquant.";
            $page = "profile";
        } else {
            $comment = $this->commentManager->findById($_GET["id"]);
            if (
                isset($_SESSION["user"]) &&
                $_SESSION["user"]->getUsername() === $comment->getUsername()
            ) {
                $response = $this->commentManager->delete($comment->getId());
                if (!$response) {
                    $error = "Impossible de supprimer la réponse";
                    header(
                        "Location: index.php?ctrl=post&action=findOne&id=" .
                            $comment->getPostId(),
                    );
                } else {
                    $info = "Réponse supprimée !";
                    $page = "singlePost";
                    $post = $this->postManager->findById($comment->getPostId());
                    $comments = $this->commentManager->findByPostId(
                        $comment->getPostId(),
                    );
                }
            }
        }
        require "view/default.php";
    }
}
