<?php

class PostManager
{
    private $collection;

    public function __construct()
    {
        $client = Database::getInstance();
        $this->collection = $client->forum->posts;
    }

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

    public function delete(string $id, User $user): bool
    {
        $post = $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        
        if (!$post) {
            return false;
        }

        if ($post["username"] !== $user->getUsername()) {
            return false;
        }

        $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $result->getDeletedCount() > 0;
    }

    public function update(string $id, User $user, ?string $title = null, ?string $content = null): bool
    {
        $post = $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        
        if (!$post) {
            return false;
        }

        if ($post["username"] !== $user->getUsername()) {
            return false;
        }

        $updateData = [];

        if ($title !== null && !empty($title)) {
            $updateData["title"] = $title;
        }

        if ($content !== null && !empty($content)) {
            $updateData["content"] = $content;
        }

        if (empty($updateData)) {
            return false;
        }

        $result = $this->collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => $updateData]
        );

        return $result->getModifiedCount() > 0;
    }
}