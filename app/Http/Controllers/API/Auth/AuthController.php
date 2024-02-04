<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiBaseController
{
    public function requestOTP(Request $request)
    {
        try {
            $request->validate(['phone_number' => 'required|numeric']);
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.phone_number_required'), Response::HTTP_BAD_REQUEST);
        }
        $otp = rand(1000, 9999);

        $otp = 1111;
        Otp::updateOrCreate(
            ['phone_number' => $request->phone_number],
            ['otp' => $otp, 'expires_at' => Carbon::now()->addMinutes(5)]
        );
        // Send OTP to the phone via SMS
        return $this->successResponse([], __('messages.otp_sent'));
    }
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|numeric',
            'otp' => 'required|numeric',
        ]);

        $otpRecord = Otp::where('phone_number', $request->phone_number)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpRecord) {
            return $this->errorResponse(__('messages.otp_invalid'), Response::HTTP_UNAUTHORIZED);
        }

        // OTP is valid
        $user = User::firstOrCreate(['phone_number' => $request->phone_number]);
        $token = $user->createToken('authToken')->plainTextToken;
        $user->type = 'customer';
        $user->save();

        // Optionally, delete the OTP record after successful verification
        $otpRecord->delete();

        return $this->successResponse(['token' => $token], __('messages.login_success'));
    }

    public function submitName(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $user = $request->user();
            $user->name = $request->name;
            $user->save();
            return $this->successResponse([], __('messages.name_updated'));
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.name_update_failed'), Response::HTTP_BAD_REQUEST);
        }
    }

    public function userInfo()
    {
        try {
            if (Auth::check()) {
                $user = User::where('id', Auth::id())->get();
                return $this->successResponse(UserResource::collection($user), '');
            }
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.name_update_failed'), Response::HTTP_BAD_REQUEST);
        }
    }
}
