<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // $items = Item::with('condition')
        //     ->where('seller_id', $user->id)
        //     ->get();

        // $orders = Order::with('item')
        //     ->where('buyer_id', $user->id)
        //     ->get();

        //Itemの seller_id = ログインユーザーのid のものだけ取得してる Userモデルに記載必要
        $items = $user->items()->with('condition')->get();
        $orders = $user->orders()->with('item')->get();

        return view('mypage', compact('user', 'items', 'orders'));
    }
}
