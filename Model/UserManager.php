<?php

    class UserManager {
        private $collection;

        public function __construct()
        {
            $client = Database::getInstance();
            $this->collection = $client->forum->users;
        }

        public function create(User $user)
        {    
            $data = [
                "username" => $user->getFirstName(),
                "email" => $user->getEmail(),
                "password" => password_hash($user->getPassword(), PASSWORD_DEFAULT),
                "role" => "user",
                "created_at" => new MongoDB\BSON\UTCDateTime()
            ];

            $result = $this->collection->insertOne($data);
            $user->setId((string) $result->getInsertedId());
        }

        public function login(string $email, string $password): ?User
        {
            $data = $this->collection->findOne(['email' => $email]);
            if (!$data) {
                return null;
            }

            if (!password_verify($password, $data["password"])) {
                return null;
            }
            
            $data["id"] = (string) $data["_id"];
            return new User($data);
        }

        public function read(string $id): ?User
        {
            $data = $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
            if (!$data) {
                return null;
            }

            $data["id"] = (string) $data["_id"];
            return new User($data);
        }

        public function getByUsername(string $username): ?User
        {
            $data = $this->collection->findOne(['username' => $username]);
            if (!$data) {
                return null;
            }

            $data["id"] = (string) $data["_id"];
            return new User($data);
        }

        public function update(User $user): bool
        {
            $updateData = [];

            if (!empty($user->getFirstName())) {
                $updateData["username"] = $user->getFirstName();
            }

            if (!empty($user->getEmail())) {
                $updateData["email"] = $user->getEmail();
            }

            if (!empty($user->getPassword())) {
                $updateData["password"] = password_hash($user->getPassword(), PASSWORD_DEFAULT);
            }

            if (empty($updateData)) {
                return false;
            }

            $result = $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($user->getId())],
                ['$set' => $updateData]
            );

            return $result->getModifiedCount() > 0;
        }

        
        public function getAll(int $limit = 100, int $skip = 0): array
        {
            $users = [];
            $cursor = $this->collection->find([], [
                'limit' => $limit,
                'skip' => $skip,
                'sort' => ['created_at' => -1]
            ]);
            
            foreach ($cursor as $data) {
                $data["id"] = (string) $data["_id"];
                $users[] = new User($data);
            }
            
            return $users;
        }
        
        public function delete(string $id): bool
        {
            $result = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
            return $result->getDeletedCount() > 0;
        }
    }

?>