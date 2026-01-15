<?php

class UserManager
{
    private $collection;

    public function __construct(MongoDB\Collection $db)
    {
        $this->collection = $db;
    }

    public function create(User $user)
    {
        $result = $this->collection->insertOne($user->toArray());
        $user->setId((string) $result->getInsertedId());

        return $user;
    }

    public function login(string $email, string $password): ?User
    {
        $data = $this->collection->findOne(["email" => $email]);
        if (!$data) {
            return null;
        }

        if (!password_verify($password, $data["password"])) {
            return null;
        }

        $data["id"] = (string) $data["_id"];
        return new User($data);
    }

    public function findOne(string $id): ?User
    {
        $data = $this->collection->findOne([
            "_id" => new MongoDB\BSON\ObjectId($id),
        ]);
        if (!$data) {
            return null;
        }

        $data["id"] = (string) $data["_id"];
        return new User($data);
    }

    public function findByEmail(string $email): ?User
    {
        $data = $this->collection->findOne(["email" => $email]);
        if (!$data) {
            return null;
        }

        $data["id"] = (string) $data["_id"];
        return new User($data);
    }

    public function getByUsername(string $username): ?User
    {
        $data = $this->collection->findOne(["username" => $username]);
        if (!$data) {
            return null;
        }

        $data["id"] = (string) $data["_id"];
        return new User($data);
    }

    public function update(User $user): bool
    {
        $id = $user->getId();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $updateData = ["username" => $username, "password" => $password];

        $result = $this->collection->updateOne(
            ["_id" => new MongoDB\BSON\ObjectId($user->getId())],
            ['$set' => $updateData],
        );

        return $result->getModifiedCount() > 0;
    }

    public function getAll(int $limit = 100, int $skip = 0): array
    {
        $users = [];
        $cursor = $this->collection->find(
            [],
            [
                "limit" => $limit,
                "skip" => $skip,
                "sort" => ["created_at" => -1],
            ],
        );

        foreach ($cursor as $data) {
            $data["id"] = (string) $data["_id"];
            $users[] = new User($data);
        }

        return $users;
    }

    public function delete(string $id): bool
    {
        $result = $this->collection->deleteOne([
            "_id" => new MongoDB\BSON\ObjectId($id),
        ]);
        return $result->getDeletedCount() > 0;
    }
}

?>
