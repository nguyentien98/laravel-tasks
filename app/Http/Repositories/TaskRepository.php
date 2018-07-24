<?php 

namespace App\Http\Repositories;

use App\Task;
use App\User;

class TaskRepository
{
	public function forUser(User $user)
	{
		return $user->tasks()
					->latest()
					->get();
	}
}
