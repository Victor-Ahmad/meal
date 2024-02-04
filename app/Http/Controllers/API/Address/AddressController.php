<?php

namespace App\Http\Controllers\API\Address;

use App\Http\Controllers\API\ApiBaseController;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddressController  extends ApiBaseController
{
    public function getAddresses()
    {
        try {
            $addresses = [];
            if (Auth::check()) {
                $userId = Auth::id();
                $addresses = Address::where('user_id', $userId)->get();
            }
            return $this->successResponse(AddressResource::collection($addresses), __('messages.addresses_retrieved_success'));
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse(__('messages.addresses_not_found'), Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return $this->errorResponse(__('messages.internal_server_error'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function editAddress(Request $request, $id)
    {
        try {
            if (Auth::check()) {
                $userId = Auth::id();
                $request->validate([
                    'name' => 'required|max:255',
                    'latitude' => 'required',
                    'longitude' => 'required',
                ]);
                $baseSlug = Str::slug($request->name);
                $uniqueSlug = $baseSlug;
                $counter = 1;
                while (Address::where('slug', $uniqueSlug)->exists()) {
                    $uniqueSlug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                Address::where('id', $id)->update([
                    'name' => $request->name,
                    'slug' => $uniqueSlug,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,

                ]);
            }
            return $this->successResponse([], __('messages.address_updated'));
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return $this->errorResponse(__('messages.address_update_failed'), Response::HTTP_BAD_REQUEST);
        }
    }
    public function deleteAddress($id)
    {
        try {
            Address::where('id', $id)->delete();
            return $this->successResponse([], __('messages.address_deleted'));
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return $this->errorResponse(__('messages.address_deletion_failed'), Response::HTTP_BAD_REQUEST);
        }
    }
    public function addAddress(Request $request)
    {
        try {
            if (Auth::check()) {
                $userId = Auth::id();
                $request->validate([
                    'name' => 'required|max:255',
                    'latitude' => 'required',
                    'longitude' => 'required',
                ]);
                $baseSlug = Str::slug($request->name);
                $uniqueSlug = $baseSlug;
                $counter = 1;
                while (Address::where('slug', $uniqueSlug)->exists()) {
                    $uniqueSlug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                Address::create([
                    'user_id' => $userId,
                    'name' => $request->name,
                    'slug' => $uniqueSlug,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,

                ]);
            }
            return $this->successResponse([], __('messages.address_added'));
        } catch (\Exception $e) {
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return $this->errorResponse(__('messages.address_add_failed'), Response::HTTP_BAD_REQUEST);
        }
    }
}
