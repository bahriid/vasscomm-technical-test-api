<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Exception;

class UserController extends Controller
{

    public function create(UserCreateRequest $request)
    {
        try {

            $data = User::query()->create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'role' => $request['role'],
            ]);

            return $this->response(200, true, 'OK', $data);
        } catch (Exception $e) {
            return $this->response(400, false, $e->getMessage());
        }
    }

    public function list(ListRequest $request)
    {
        try {

            $data = User::query()
                ->when($request['take'], fn($q) => $q->take($request['take']))
                ->when($request['search'], fn($q) => $q->where('name', 'like', '%' . $request['search'] . '%'))
                ->when($request['skip'], fn($q) => $q->skip($request['skip'])->take($request['take']))
                ->latest()
                ->paginate($request['per_page'] ?? 10);

            return $this->response(200, true, 'OK', $data);
        } catch (Exception $e) {
            return $this->response(400, false, $e->getMessage());
        }
    }

    public function find($id)
    {
        try {

            $data = User::query()->find($id);

            if (!$data) {
                return $this->response(404, false, 'Data tidak ditemukan');
            }

            return $this->response(200, true, 'OK', $data);
        } catch (Exception $e) {
            return $this->response(400, false, $e->getMessage());
        }
    }

    public function update($id, UserUpdateRequest $request)
    {
        try {

            $data = User::query()->find($id);

            if (!$data) {
                return $this->response(404, false, 'Data tidak ditemukan');
            }

            $data->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'role' => $request['role']
            ]);

            return $this->response(200, true, 'OK', $data);
        } catch (Exception $e) {
            return $this->response(400, false, $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {

            $data = User::query()->find($id);

            if (!$data) {
                return $this->response(404, false, 'Data tidak ditemukan');
            }

            $data->delete();

            return $this->response(200, true, 'OK', []);
        } catch (Exception $e) {
            return $this->response(400, false, $e->getMessage());
        }
    }
}
