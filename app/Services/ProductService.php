<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService extends BaseService
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getAllWithCategory($perPage = 10)
    {
        return $this->model->with('category')->latest()->paginate($perPage);
    }

    public function create(array $data): ?Product
    {
        DB::beginTransaction();

        try {

            // Tạo sản phẩm
            $product = $this->model->create($data);

            // (Nếu có thêm thao tác như gắn tag, lưu ảnh, tạo log... thì để ở đây)

            // Xác nhận tất cả đều OK, ghi vào CSDL
            DB::commit();
            return $product;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Product $product, array $data): bool
    {
        try {
            return $product->update($data);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(Product $product): bool
    {
        try {
            return $product->delete();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
