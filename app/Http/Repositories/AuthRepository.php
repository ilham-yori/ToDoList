<?php

namespace App\Http\Repositories;

use App\Http\Helpers\MongoModel;
use Carbon\Carbon;

class AuthRepository
{
    private MongoModel $user;

	public function __construct()
	{
		$this->user = new MongoModel('users');
	}

    public function create(array $data)
	{
		$dataSaved = [
			'name'=>$data['name'],
			'email'=>$data['email'],
			'password'=>$data['password'],
            'created_at'=>Carbon::now()->timestamp
		];

		$id = $this->user->save($dataSaved);
		return $id;
	}
}
