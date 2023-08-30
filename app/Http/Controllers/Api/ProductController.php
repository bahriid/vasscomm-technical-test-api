<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductListRequest;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    public function create(ProductCreateRequest $request)
    {
        try {

            $data = Product::query()->create($request->validated());

            return $this->response(200, true, 'OK', $data);
        } catch (Exception $e) {
            return $this->response(400, false, $e->getMessage());
        }
    }

    public function list(ProductListRequest $request)
    {
        try {

            $data = Product::query()
                ->when($request['take'], fn($q) => $q->take($request['take']))
                ->when($request['search'], fn($q) => $q->where('name', 'like', '%' . $request['search'] . '%')
                    ->orwhere('description', 'like', '%' . $request['search'] . '%'))
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

            $data = Product::query()->find($id);

            if (!$data) {
                return $this->response(404, false, 'Data tidak ditemukan');
            }

            return $this->response(200, true, 'OK', $data);
        } catch (Exception $e) {
            return $this->response(400, false, $e->getMessage());
        }
    }

    public function update($id, ProductCreateRequest $request)
    {
        try {

            $data = Product::query()->find($id);

            if (!$data) {
                return $this->response(404, false, 'Data tidak ditemukan');
            }

            $data->update($request->validated());

            return $this->response(200, true, 'OK', $data);
        } catch (Exception $e) {
            return $this->response(400, false, $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {

            $data = Product::query()->find($id);

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
