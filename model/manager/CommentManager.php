<?php
class CommentManager
{
    private MongoDB\Collection $collection;
    public function __construct(MongoDB\Database $db)
    {
        $this->collection = $db->collection;
    }

    public function createComment(Comment $comment): Comment
    {
        $result = $this->collection->insertOne($comment->toArray());
        $comment->setId($result->getInsertedId());
        return $comment;
    }

    public function updateComment(Comment $comment): bool
    {
        $result = $this->collection->updateOne(
            ['_id' => $comment->getId()],
            ['$set' => $comment->toArray()]
        );
        return $result->getModifiedCount() > 0;
    }

    public function deleteComment(Comment $comment): bool
    {
        $result = $this->collection->deleteOne(['_id' => $comment->getId()]);
        return $result->getDeletedCount() > 0;
    }

    public function getCommentsByPostId($postId): array
    {
        return $this->collection->find(['postId' => $postId])->toArray();
    }

    public function getCommentById(string $id): ?Comment
    {
        return $this->collection->findOne(['_id' => $id]);
    }

    public function getCommentsByUserId(string $userId): array
    {
        return $this->collection->find(['userId' => $userId])->toArray();
    }
