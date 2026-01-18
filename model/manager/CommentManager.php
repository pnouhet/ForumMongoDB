<?php

class CommentManager
{
    private $collection;

    public function __construct(MongoDB\Collection $collection)
    {
        $this->collection = $collection;
    }

    public function create(Comment $comment): string
    {
        $result = $this->collection->insertOne($comment->toArray());
        return $result->getInsertedId();
    }

    public function findByPostId(string $postId): array
    {
        $comments = $this->collection->find([
            "postId" => $postId,
        ]);
        return iterator_to_array($comments);
    }

    public function findByUsername(string $username): array
    {
        $comments = $this->collection->find([
            "username" => $username,
        ]);
        return iterator_to_array($comments);
    }

    public function delete(string $id): bool
    {
        $result = $this->collection->deleteOne([
            "_id" => new MongoDB\BSON\ObjectId($id),
        ]);
        return $result->getDeletedCount() > 0;
    }

    public function update(Comment $comment): bool
    {
        $result = $this->collection->updateOne(
            ["_id" => new MongoDB\BSON\ObjectId($comment->getId())],
            ['$set' => $comment->toArray()],
        );
        return $result->getModifiedCount() > 0;
    }

    public function findById(string $id): ?Comment
    {
        $data = $this->collection->findOne([
            "_id" => new MongoDB\BSON\ObjectId($id),
        ]);
        if (!$data) {
            return null;
        }
        $data = $data->getArrayCopy();
        $data["id"] = (string) $data["_id"];
        unset($data["_id"]);
        return new Comment($data);
    }
}
