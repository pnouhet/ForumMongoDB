<?php

class UserController
{
    private $db;
    private $UserManager;

    public function __construct($db)
    {
        require_once "./model/entity/User.php";
        require_once "../model/manager/UserManager.php";
        $this->db = $db;
        $this->UserManager = new UserManager($this->db->user);
    }
}
?>
