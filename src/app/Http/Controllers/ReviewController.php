<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Notification;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Order $order)
    {
        return view('items.review-create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        Review::create([
            'order_id' => $order->id,
            'reviewer_id' => auth()->id(),
            'reviewee_id' => $order->seller_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        Notification::create([
            'user_id' => $order->seller_id,
            'type' => 'order_created',
            'item_id' => $order->item_id,
            'is_read' => false,
        ]);

        return redirect()->route('mypage')->with('success', 'レビューを投稿しました');
    }
}
