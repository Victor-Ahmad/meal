<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\API\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProductController extends ApiBaseController
{
    public function getProductsBySubcategory(Request $request, $subCategoryId)
    {
        try {
            $products = Product::where('sub_category_id', $subCategoryId)
                ->paginate(10);

            return $this->successResponse(ProductResource::collection($products));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getProductById($productId)
    {
        try {
            $product = Product::with('offers')->where('id',$productId)->get();
            return $this->successResponse(ProductResource::collection($product), __('messages.product_retrieved_success'));
        } catch (ModelNotFoundException $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return $this->errorResponse(__('messages.product_not_found'), Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return $this->errorResponse(__('messages.internal_server_error'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
