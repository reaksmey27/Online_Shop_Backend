<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingOrders = Order::where('status', 'pending')->count();
        $lowStockProducts = Product::where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->where('is_active', true)
            ->orderBy('stock')
            ->limit(5)
            ->get();
        $outOfStock = Product::where('stock', 0)->where('is_active', true)->count();

        // Best sellers: top 5 products by units sold
        $bestSellers = OrderItem::selectRaw('product_id, SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->with('product:id,name,price,image,stock')
            ->get();

        return view('admin.dashboard', [
            'totalOrders'      => Order::count(),
            'totalRevenue'     => Order::where('payment_status', 'paid')->sum('total_amount'),
            'totalProducts'    => Product::count(),
            'totalUsers'       => User::count(),
            'pendingOrders'    => $pendingOrders,
            'outOfStock'       => $outOfStock,
            'recentOrders'     => Order::with('user')->latest()->limit(10)->get(),
            'lowStockProducts' => $lowStockProducts,
            'bestSellers'      => $bestSellers,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
