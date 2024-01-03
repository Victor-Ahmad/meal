<?php

namespace App\Http\Controllers;

use App\Charts\CommonChart;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class ProfileController extends Controller
{

    public function dashboard()
    {

        $labels = [];

        $dates = [];
        for ($i = 7; $i >= 0; $i--) {
            $date = Carbon::now('Asia/Riyadh')->subDays($i)->format('Y-m-d');
            $dates[] = $date;

            $labels[] = date('j M Y', strtotime($date));
        }
        

        $today = Carbon::now('Asia/Riyadh');
        $sevenDaysAgo = Carbon::now('Asia/Riyadh')->subDays(7);
        $dateRange = [];
        $currentDate = clone $sevenDaysAgo;

        while ($currentDate <= $today) {
            $dateRange[] = $currentDate->toDateString();
            $currentDate->addDay();
        }
        $all_sell_values = Order::select(DB::raw('date(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$sevenDaysAgo, $today])
            ->groupBy(DB::raw('date(created_at)'))
            ->get();

        $countsByDate = $all_sell_values->pluck('count', 'date')->toArray();
        $all_sell_values = array_map(function ($date) use ($countsByDate) {
            return isset($countsByDate[$date]) ? $countsByDate[$date] : 0;
        }, $dateRange);

        $sells_chart_1 = new CommonChart;

        $sells_chart_1->labels($labels)->options($this->__chartOptions(
            __(
                "الطلبات",
                ['currency' => 'SAR']
            )
        ));
        $sells_chart_1->dataset("الطلبات", 'line', $all_sell_values);



        $sells_chart_2 = new CommonChart;
        $sells_chart_2->labels($labels)->options($this->__chartOptions(__('الطلبات', ['currency' => 'SAR'])));
        $sells_chart_2->dataset('الطلبات', 'bar', $all_sell_values);


        return view('dashboard', [
            'sells_chart_1' => $sells_chart_1,
            'sells_chart_2' => $sells_chart_2,

        ]);
    }

    private function __chartOptions($title)
    {
        return [
            'yAxis' => [
                'title' => [
                    'text' => $title,
                ],
            ],
            'legend' => [
                'align' => 'right',
                'verticalAlign' => 'top',
                'floating' => true,
                'layout' => 'vertical',
                'padding' => 20,
            ],
        ];
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->post());
        // dd($request->user());
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        User::where('id', $request->user()->id)->update(['mode' => $request->mode]);

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
