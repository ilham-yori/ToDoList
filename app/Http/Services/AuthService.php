<?php

namespace App\Http\Services;

use App\Http\Repositories\AuthRepository;

class AuthService
{
    private AuthRepository $authRepository;

	public function __construct()
    {
		$this->authRepository = new AuthRepository();
	}

    public function register(array $data)
	{
        $registerID = $this->authRepository->create($data);
		return $registerID;
	}

}
