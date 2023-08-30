<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        try {
            $user = User::query()->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);

            /*
             * Create Token
             */
            $data['token'] = $user->createToken('vasscomm')->accessToken;
            $data['name'] = $user->name;

            return $this->response(200, true, 'OK', $data);
        } catch (Exception $e) {
            return $this->response(400, false, $e->getMessage());
        }

    }
}
