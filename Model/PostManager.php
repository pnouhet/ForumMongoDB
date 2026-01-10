<?php

class PostManager
{
    public function create(string $title, string $content, User $author)
    {
        $data = [
            "title" => $title,
            "content" => $content,
            "author" => [
                "_id" => new MongoDB\BSON\ObjectId($author->getId()),
                "username" => $author->getFirstName(),
                "avatar_url" => "image.png"
            ],
            "stats" => ["views" => 0, "replies_count" => 0],
            "created_at" => new MongoDB\BSON\UTCDateTime(),
            "last_reply_at" => new MongoDB\BSON\UTCDateTime()
        ];

        $this->collection->insertOne($data);
    }
}