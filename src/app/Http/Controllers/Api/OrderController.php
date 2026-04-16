<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():AnonymousResourceCollection
    {
        $orders = auth()->user()->orders()->with('item', 'review')->get();

        return OrderResource::collection($orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function soldIndex()
    {
        $soldOrders = auth()->user()->soldOrders()->with('item')->get();

        return OrderResource::collection($soldOrders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Order $order)
    {
        if (auth()->id() !== $order->seller_id) {
            return response()->json([
                'message' => '権限がありません',
            ], 403);
        }
        if ($order->status !== 1) {
            return response()->json([
                'message' => '更新できません',
            ], 422);
        }
        //サーバーがリクエストの形式は理解したものの、内容（意味）が不正で処理できないことを示すエラー

        $order->update([
            'status' => 2,
        ]);

        return new OrderResource($order->fresh());
        //$order->fresh() は更新後の最新データをDBから取り直すメソッド
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function receive(Order $order)
    {
        if (auth()->id() !== $order->buyer_id) {
            return response()->json([
                'message' => '権限がありません',
            ], 403);
        }
        if ($order->status !== 2) {
            return response()->json([
                'message' => '更新できません',
            ], 422);
        }

        $order->update([
            'status' => 3,
        ]);

        return new OrderResource($order->fresh());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
