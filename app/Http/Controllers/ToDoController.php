<?php

namespace App\Http\Controllers;

use App\Http\Services\ToDoService;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    private ToDoService $todoService;

	public function __construct() {
		$this->todoService = new ToDoService();
	}
}
