<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;
use MongoDB\BSON\ObjectId;
use MongoDB\Client;
use MongoDB\Collection;

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
        $id = isset($data['_id']) ? $data['_id']: (string) new \MongoDB\BSON\ObjectId();
        $this->collection->updateOne(['_id' => $id], ['$set' => $data], ['upsert'=>true]);
        return (string) $id;
    }

    public function deleteQuery($filter)
    {
        return $this->collection->deleteOne($filter);
    }
}
