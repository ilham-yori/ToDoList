<?php

namespace App\Http\Controllers;

use App\Http\Services\ToDoService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    private ToDoService $todoService;

	public function __construct() {
		$this->todoService = new ToDoService();
	}

    public function createToDo(Request $request)
    {
        $request->validate([
			'title'=>'required|string|min:3',
			'description'=>'required|string',
            'assigned'=>'required|string',
		]);

        $data = [
            'title'=> $request->title,
            'description'=>$request->description,
            'assigned'=> $request->assigned,
            'created_at'=>Carbon::now()
        ];

		$this->todoService->addToDoList($data);

		return response()->json("Assignment created successfully", 201);
    }

    public function allAssignment()
	{
		$assignment = $this->todoService->getAllToDo();
		return response()->json($assignment, 200);
	}

    public function assignmentById(String $uniqueID)
    {
        $assignment = $this->todoService->getToDoById($uniqueID);
		return response()->json($assignment, 200);
    }

    public function deleteToDo(Request $request)
	{
		$request->validate([
			'assignment_id'=>'required',
		]);

        $assignmentID = $request->assignment_id;

		$assignment = $this->todoService->getToDoById($assignmentID);

		if(!$assignment)
		{
			return response()->json([
				"message"=> "Assignment ".$assignmentID." Not Found"
			], 401);
		}

        $this->todoService->deleteAssignment($assignmentID);

		return response()->json([
			'message'=> 'Successfully Delete Assignment With This ID :  '.$assignmentID,
		], 200);
	}

    public function updateTodo(Request $request)
	{
		$request->validate([
            'assignment_id'=>'required',
			'title'=>'string|min:3',
			'description'=>'|string',
            'assigned'=>'string',
		]);

        $assignmentID = $request->assignment_id;

        $data = [
            'title'=> $request->title,
            'description'=>$request->description,
            'assigned'=> $request->assigned,
        ];

		$assignment = $this->todoService->getToDoById($assignmentID);

		$this->todoService->updateToDo($assignment, $data);

		return response()->json("Assignment has been updated", 200);
	}
}
