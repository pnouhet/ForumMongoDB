<?php

class PostManager
{
    private $collection;

    public function __construct(MongoDB\Collection $collection)
    {
        $this->collection = $collection;
    }

    public function create(Post $post): string
    {
        $result = $this->collection->insertOne($post->toArray());
        return $result->getInsertedId();
    }

    public function delete(string $id): bool
    {
        $result = $this->collection->deleteOne([
            "_id" => new MongoDB\BSON\ObjectId($id),
        ]);
        return $result->getDeletedCount() > 0;
    }

    public function update(Post $post): bool
    {
        $result = $this->collection->updateOne(
            ["_id" => new MongoDB\BSON\ObjectId($post->getId())],
            ['$set' => $post->toArray()],
        );
        return $result->getModifiedCount() > 0;
    }

    public function findById(string $id): ?Post
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
        return new Post($data);
    }

    public function findAll(): array
    {
        $posts = $this->collection->find();
        return iterator_to_array($posts);
    }

    public function findByUsername(string $username): array
    {
        $posts = $this->collection->find([
            "username" => $username,
        ]);
        return iterator_to_array($posts);
    }
}
