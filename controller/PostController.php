<?php
class PostController
{
    private $db;
    private $PostManager;

    public function __construct($db)
    {
        $this->db = $db;
        $this->PostManager = new PostManager($this->db->post);
    }
}
?>
