<?php

namespace App\Http\Controllers\API\Category;

use App\Http\Controllers\API\ApiBaseController;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\error;

class CategoryController extends ApiBaseController
{
    public function getCategory($id)
    {
        try {
            
            $subCategories = SubCategory::where('category_id',$id)->get();
            return $this->successResponse(SubCategoryResource::collection($subCategories), __('messages.category_retrieved_success'));
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse(__('messages.category_not_found'), Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
           error_log('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());
            return $this->errorResponse(__('messages.internal_server_error'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
