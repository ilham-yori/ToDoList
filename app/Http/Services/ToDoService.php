<?php

namespace App\Http\Services;

use App\Http\Repositories\ToDoRepository;

class ToDoService
{
    private ToDoRepository $todoRepository;

	public function __construct()
    {
		$this->todoRepository = new ToDoRepository();
	}

    public function addToDoList(array $data)
	{
        $assignmentID = $this->todoRepository->create($data);
		return $assignmentID;
	}

    public function getToDoById(string $id)
	{
		$assignment = $this->todoRepository->getById($id);
		return $assignment;
	}

    public function getAllToDo()
	{
		$assignments = $this->todoRepository->getAll();
		return $assignments;
	}

    public function deleteAssignment(string $id)
    {
        $assignment = $this->todoRepository->deleteAssignment($id);
		return $assignment;
    }

    public function updateToDo(array $oldData, array $newData)
	{
		if(isset($newData['title']))
		{
			$oldData['title'] = $newData['title'];
		}

		if(isset($newData['description']))
		{
			$oldData['description'] = $newData['description'];
		}

        if(isset($newData['assigned']))
		{
			$oldData['assigned'] = $newData['assigned'];
		}

		$id = $this->todoRepository->save($oldData);
		return $id;
	}

}
