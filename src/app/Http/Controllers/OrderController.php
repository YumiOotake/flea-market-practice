<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class OrderController extends Controller
{
    public function confirm(Item $item)
    {
        $item->load('condition');
        return view('items.order', compact('item'));
    }

    //決済なしはこっち
    // public function store(Item $item)
    // {
    //     if ($item->status === 2) {
    //         return back()->with('error', 'この商品はすでに売り切れです');
    //     }
    //     if ($item->seller_id === auth()->id()) {
    //         return back()->with('error', '自分の商品は購入できません');
    //     }

    //     Order::create([
    //         'item_id' => $item->id,
    //         'buyer_id' => auth()->id(),
    //         'seller_id' => $item->seller_id,
    //         'status' => 1,
    //     ]);
    //     $item->update([
    //         'status' => 2,
    //     ]);

    //     return redirect()->route('mypage')->with('success', '商品を購入しました');
    // }


    // 「購入する」→ Stripeへ
    public function checkout(Item $item)
    {
        // 自分の商品チェック
        if (auth()->id() === $item->seller_id) {
            return back()->with('error', '自分の商品は購入できません');
        }

        // 売り切れチェック
        if ((int)$item->status === 2) {
            return back()->with('error', 'この商品はすでに売り切れです');
        }

        // Stripeにシークレットキーをセット
        Stripe::setApiKey(config('services.stripe.secret'));

        // Stripeのチェックアウトセッション作成
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => 'jpy',        // 日本円
                    'unit_amount'  => $item->price, // 円はそのまま（ドルは×100が必要）
                    'product_data' => [
                        'name' => $item->name,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            // 成功・キャンセル時のリダイレクト先
            'success_url' => route('orders.success', $item) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('orders.cancel', $item),
        ]);

        // Stripeの決済画面へリダイレクト
        return redirect($session->url);
    }

    // 決済成功後
    public function success(Item $item, Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // session_idでStripeに決済完了を確認
        $session = Session::retrieve($request->session_id);

        // 念のため決済完了チェック（不正アクセス対策）
        if ($session->payment_status !== 'paid') {
            return redirect()->route('items.show', $item)
                ->with('error', '決済が完了していません');
        }

        // 二重購入防止
        if ((int)$item->status === 2) {
            return redirect()->route('mypage')
                ->with('error', 'この商品はすでに売り切れです');
        }

        // 注文作成
        Order::create([
            'item_id'   => $item->id,
            'buyer_id'  => auth()->id(),
            'seller_id' => $item->seller_id,
            'status'    => 1,
        ]);

        $item->update(['status' => 2]);

        return redirect()->route('mypage')->with('success', '購入が完了しました！');
    }

    // キャンセル時
    public function cancel(Item $item)
    {
        return redirect()->route('orders.confirm', $item)
            ->with('error', '決済がキャンセルされました');
    }
}
