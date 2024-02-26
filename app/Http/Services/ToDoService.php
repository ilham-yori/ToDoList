<?

namespace App\Http\Services;

use App\Http\Repositories\ToDoRepository;

class ToDoService
{
    private ToDoRepository $todoRepository;

	public function __construct() {
		$this->todoRepository = new ToDoRepository();
	}
}
