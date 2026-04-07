<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function store(Item $item)
    {
        if (auth()->id() === $item->seller_id) {
            return back()->with('error', '自分の商品はお気に入り登録できません');
        }

        //すでに登録してるかチェックして、なければ作る
        Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'item_id' => $item->id,
        ]);

        return redirect()->route('items.index')->with('success', 'お気に入りを登録しました');
    }

    public function destroy(Item $item)
    {
        Favorite::where('user_id', auth()->id())
            ->where('item_id', $item->id)
            ->delete();

        return redirect()->route('items.index')->with('success', 'お気に入りを解除しました');
    }
}
