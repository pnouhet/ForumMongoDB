<?php

class PostManager
{
    public function create(string $title, string $content, User $author)
    {
        $data = [
            "title" => $title,
            "content" => $content,
            "username" => $author->getUsername(),
            "created_at" => new MongoDB\BSON\UTCDateTime(),
            "last_reply_at" => new MongoDB\BSON\UTCDateTime()
        ];

        $this->collection->insertOne($data);
    }
}