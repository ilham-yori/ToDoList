<?php

namespace App\Http\Helpers;

use MongoDB\Client;

class MongoModel
{
    private $collection;

    public function __construct(string $collectionName)
    {
        $client = new Client(config('database.connections.mongodb.dsn'));
        $this->collection = $client->selectDatabase(config('database.connections.mongodb.database'))->selectCollection($collectionName);
    }

    public function get($filter = [])
    {
        return $this->collection->find($filter)->toArray();
    }

    public function find($filter)
    {
        return $this->collection->findOne($filter);
    }

    public function save(array $data)
    {
        if (isset($data['_id'])) {
            $id = $data['_id'];
            $data['_id'] = new ObjectId($id);
            $this->collection->replaceOne(['_id' => $data['_id']], $data);
            return $id;
        } else {
            $result = $this->collection->insertOne($data);
            return $result->getInsertedId();
        }
    }

    public function deleteQuery($filter)
    {
        return $this->collection->deleteOne($filter);
    }
}
