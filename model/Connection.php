<?php
use MongoDB\Client;

class Connection
{
    private string $uri;
    private $db;
    public function __construct($uri)
    {
        $this->uri = $uri;
        $client = new MongoDB\Client($this->uri);
        $this->db = $client->forum;
    }

    public function getDB()
    {
        return $this->db;
    }
}