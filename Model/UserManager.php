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
    }

?>