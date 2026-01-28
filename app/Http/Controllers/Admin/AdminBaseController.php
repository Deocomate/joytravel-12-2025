<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\DashboardService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminBaseController extends Controller
{
    public function __construct(private DashboardService $dashboardService)
    {
    }

    public function resetPassword()
    {
        $user = User::where('email', 'root@gmail.com')->first();

        if ($user) {
            $user->password = Hash::make('admin123');
            $user->save();
            return response()->json(['message' => 'Password for root@gmail.com has been reset to admin123']);
        }

        return response()->json(['message' => 'User root@gmail.com not found'], 404);
    }

    public function index()
    {
        $stats = $this->dashboardService->getDashboardStats();
        $totalRevenue = $stats['totalRevenue'];
        $totalOrders = $stats['totalOrders'];
        $totalCustomers = $stats['totalCustomers'];
        $totalTours = $stats['totalTours'];

        return view("admin.dashboard.index", compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'totalTours'
        ));
    }

    public function getChartData(Request $request): JsonResponse
    {
        $filter = $request->get('filter', 'month');
        $data = $this->dashboardService->getChartData($filter);

        return response()->json($data);
    }


}
