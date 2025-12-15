<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countUsers = [
            'active' => User::withoutTrashed()->count(),
            'trash'  => User::onlyTrashed()->count(),
        ];

        $countProducts = [
            'active' => Product::withoutTrashed()->count(),
            'trash'  => Product::onlyTrashed()->count(),
        ];

        $count = [
            'delivered' => Order::where('status', 1)->count(),
            'pending'   => Order::where('status', 0)->count(),
        ];

        return view('admin.dashboard', compact(
            'countUsers',
            'countProducts',
            'count'
        ));
    }
}
