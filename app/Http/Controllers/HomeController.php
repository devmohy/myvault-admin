<?php

namespace App\Http\Controllers;

use App\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasRole('attendant')) {
            $recentOrders = Order::with(['user', 'address'])
                ->where('status', 'PENDING')
                ->where(function ($query) {
                    $query->where('attendant_id', auth()->user()->id)
                        ->orWhere(function ($query) {
                            $query->whereNull('attendant_id');
                        });
                })->latest()->get();
        }
        if (auth()->user()->hasRole('delivery')) {
            $recentOrders = Order::with(['user', 'address'])
            ->where('status', 'PENDING')
            ->where(function ($query) {
                $query->where('delivery_id', auth()->user()->id)
                    ->orWhere(function ($query) {
                        $query->whereNull('delivery_id');
                    });
            })->latest()->get();
        }
        if (auth()->user()->hasRole('user')) {
            $recentOrders = Order::with(['user', 'address'])->where('user_id', auth()->user()->id)->latest()->get();
        }

        if (auth()->user()->hasRole('super-admin')) {
            $recentOrders = Order::with(['user', 'address'])->latest()->get();
        }
        return view('home', compact('recentOrders'));
    }
}
