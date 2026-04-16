<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewStoreRequest;
use Illuminate\Http\Request;
use App\Models\Order;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewStoreRequest $request, Order $order)
    {
        if (auth()->id() !== $order->buyer_id) {
            return response()->json([
                'message' => '権限がありません',
            ], 403);
        }
        if ($order->status !== 3) {
            return response()->json([
                'message' => '更新できません',
            ], 422);
        }
        if ($order->review) {
            return response()->json([
                'message' => 'すでにレビュー済みです',
            ], 422);
        }

        $review = $order->review()->create([
            'reviewer_id' => auth()->id(),
            'reviewee_id' => $order->seller_id,
            'rating' => $request->rating,
            'comment' => $request->comment ?? null,
        ]);

        return response()->json($review, 201);
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
