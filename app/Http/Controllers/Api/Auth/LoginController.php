<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public function __invoke(LoginRequest $request)
    {
        try {
            /*
             * Logging in
             */
            $login = Auth::attempt(['email' => $request['email'], 'password' => $request['password']]);
            if (!$login) {
                return $this->response(400, false, 'Email atau Password salah');
            }

            /*
             * Getting logged in user
             */
            $user = auth()->user();

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
