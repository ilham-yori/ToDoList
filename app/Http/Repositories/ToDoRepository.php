<?php

namespace App\Http\Repositories;

use App\Http\Helpers\MongoModel;
use Carbon\Carbon;

class ToDoRepository
{
    private MongoModel $assignment;

	public function __construct()
	{
		$this->assignment = new MongoModel('assignment');
	}

    public function create(array $data)
	{
		$dataSaved = [
			'title'=>$data['title'],
			'description'=>$data['description'],
			'assigned'=>$data['assigned'],
			'created_at'=>$data['created_at']
		];

		$id = $this->assignment->save($dataSaved);
		return $id;
	}

    public function getById(string $id)
	{
		$document = $this->assignment->find(['_id' => $id])->getArrayCopy();
		return $document;
	}

    public function getAll()
	{
		$assignment = $this->assignment->get([]);
		return $assignment;
	}

    public function deleteAssignment(string $id){
        $assignment = $this->assignment->deleteQuery(['_id'=>$id]);
		return $assignment;
    }

    public function save(array $editedData)
	{
		$id = $this->assignment->save($editedData);
		return $id;
	}
}
