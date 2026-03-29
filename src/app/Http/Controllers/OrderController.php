<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function confirm(Item $item)
    {
        $item->load('condition');
        return view('items.order', compact('item'));
    }

    public function store(Item $item)
    {
        if ($item->status === 2) {
            return back()->with('error', 'この商品はすでに売り切れです');
        }
        if ($item->seller_id === auth()->id()) {
            return back()->with('error', '自分の商品は購入できません');
        }

        Order::create([
            'item_id' => $item->id,
            'buyer_id' => auth()->id(),
            'seller_id' => $item->seller_id,
            'status' => 1,
        ]);
        $item->update([
            'status' => 2,
        ]);

        return redirect()->route('mypage')->with('success', '商品を購入しました');
    }
}
