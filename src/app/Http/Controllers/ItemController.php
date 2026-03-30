<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category', 'condition')->paginate(5);
        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    public function show(Item $item)
    {
        $item->load('category', 'condition');
        return view('items.detail', compact('item'));
    }

    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('items.create', compact('categories', 'conditions'));
    }

    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();
        $imagePath = $request->file('image')->store('images', 'public');

        Item::create([
            ...$validated,
            'seller_id'    => auth()->id(),
            'image'        => $imagePath,
        ]);

        // $item = $request->only([
        //     'name',
        //     'price',
        //     'category_id',
        //     'condition_id',
        //     'description',
        // ]);
        // $item['seller_id'] = auth()->id();
        // $item['image'] = $request->file('image')->store('images', 'public');

        // Item::create($item);

        return redirect()->route('mypage')->with('success', '商品を出品しました');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        $conditions = Condition::all();

        return view('items.edit', compact('item', 'categories', 'conditions'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $this->authorize('update', $item);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($item->image);

            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $item->update($validated);

        // $data = $request->only([
        //     'name',
        //     'price',
        //     'category_id',
        //     'condition_id',
        //     'description',
        // ]);
        // $data['seller_id'] = auth()->id(); userは変更なし

        // if ($request->hasFile('image')) {
        //     Storage::disk('public')->delete($item->image);

        //     $data['image'] = $request->file('image')->store('images', 'public');
        // }

        // $item->update($data);

        return redirect()->route('mypage')->with('success', '商品を編集しました');
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);

        Storage::disk('public')->delete($item->image);

        $item->delete();

        return redirect()->route('mypage')->with('success', '商品を取り消しました');
    }

    public function search(Request $request)
    {
        $items = Item::with('category', 'condition')
            ->keywordSearch($request->keyword)
            ->categorySearch($request->category_id)
            ->statusSearch($request->status)
            ->paginate(5);

        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }
}
