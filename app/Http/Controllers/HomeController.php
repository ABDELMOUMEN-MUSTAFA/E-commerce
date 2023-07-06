<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            // Top Selling Products
            $topSellingProducts = DB::table('order_product')
                ->select(DB::raw('
                products.name, 
                SUM(order_product.quantity) AS quantity, 
                SUM(order_product.quantity * order_product.unit_price) AS amount'))
                ->join('orders', 'order_product.order_id', '=', 'orders.id')
                ->join('products', 'order_product.product_id', '=', 'products.id')
                ->where('order_status_id', 4)
                ->groupBy('order_product.product_id')
                ->orderBy('amount', 'desc')
                ->take(5)
                ->get();

            // Array of percentage change
            $percentageChange = [];

            // Orders
            $currentMonthOrders = Order::whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
            $lastMonthOrders =  Order::whereMonth('created_at', \Carbon\Carbon::now()->subMonth()->month)->count();
            $percentageChange["orders"] = ($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders * 100;

            // Customers
            $currentMonthCustomers = User::whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
            $lastMonthCustomers = User::whereMonth('created_at', \Carbon\Carbon::now()->subMonth()->month)->count();
            $percentageChange["customers"] = ($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers * 100;

            // Products
            $currentMonthProducts = Product::whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
            $lastMonthProducts = Product::whereMonth('created_at', \Carbon\Carbon::now()->subMonth()->month)->count();
            $percentageChange["products"] = ($currentMonthProducts - $lastMonthProducts) / $lastMonthProducts * 100;

            // Revenue
            $lastTwoMonthsRevenue = DB::table('order_product')
                ->select(DB::raw(' 
                MONTH(orders.delivered_at) AS month, 
                SUM(order_product.quantity * order_product.unit_price) AS revenue'))
                ->join('orders', 'order_product.order_id', '=', 'orders.id')
                ->where('order_status_id', 4)
                ->groupBy(DB::raw('MONTH(orders.delivered_at)'))
                ->havingRaw('month >= MONTH(NOW()) - 1')
                ->orderBy('month')
                ->get();

            if ($lastTwoMonthsRevenue->get(1) !== null) {
                $percentageChange["revenue"] = ($lastTwoMonthsRevenue->get(1)->revenue - $lastTwoMonthsRevenue->get(0)->revenue) / $lastTwoMonthsRevenue->get(0)->revenue * 100;
            } else {
                $percentageChange["revenue"] = (0 - $lastTwoMonthsRevenue->get(0)->revenue) / $lastTwoMonthsRevenue->get(0)->revenue * 100;
            }


            // Top Selling Countries
            $topSellingCountries = DB::table('order_product')
                ->select(DB::raw(' 
                countries.name,
                COUNT(DISTINCT users.id) AS numberCustomers'))
                ->join('orders', 'order_product.order_id', '=', 'orders.id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('countries', 'users.country_id', '=', 'countries.id')
                ->where('order_status_id', 4)
                ->groupBy('countries.name')
                ->take(7)
                ->get();

            return view('app.admin.dashboard', compact('topSellingProducts', 'currentMonthOrders', 'currentMonthCustomers', 'currentMonthProducts', 'lastTwoMonthsRevenue', 'percentageChange', 'topSellingCountries'));
        }

        $countries = Country::all();
        return view('app.customer.dashboard', compact('countries'));
    }


    public function getMonthlyStatistics()
    {
        if (auth()->user()->is_admin) {
            $monthlyStatistics = DB::table('order_product')
                ->select(DB::raw(' 
                MONTH(orders.delivered_at) AS month,
                SUM(order_product.quantity * order_product.unit_price) AS revenue,
                COUNT(order_product.product_id) AS sales'))
                ->join('orders', 'order_product.order_id', '=', 'orders.id')
                ->where('order_status_id', 4)
                ->whereYear('orders.delivered_at', now()->year)
                ->groupBy('month')
                ->get();

            foreach ($monthlyStatistics as $statistic) {
                $statistic->month = \DateTime::createFromFormat('!m', $statistic->month)->format('F');
                $statistic->revenue = str_replace(',', '', $statistic->revenue);
            }

            return response()->json($monthlyStatistics);
        }
    }
}
