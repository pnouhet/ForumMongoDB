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
}
