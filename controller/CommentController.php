<?php
class CommentController
{
    private $db;
    private $CommentManager;

    public function __construct($db)
    {
        $this->db = $db;
        $this->CommentManager = new CommentManager($this->db->comment);
    }
}
?>
