@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/order.css') }}">
@endsection
@section('content')
    <div class="item__content">
        <div class="item__heading">
            <h2 class="heading-ttl item__heading-ttl">購入確認</h2>
        </div>

        <div class="order-confirm">
            <div class="order-confirm__item">
                <img src="{{ asset('storage/' . $item->image) }}" alt="" class="order-confirm__image">
            </div>
            <div class="order-confirm__item">
                <span class="order-confirm__label">商品名</span>
                <p class="order-confirm__text">{{ $item->name }}</p>
            </div>
            <div class="order-confirm__item">
                <span class="order-confirm__label">金額</span>
                <p class="order-confirm__text">{{ $item->price }}円</p>
            </div>
            <div class="order-confirm__item">
                <span class="order-confirm__label">状態</span>
                <p class="order-confirm__text">{{ $item->condition->name }}</p>
            </div>
        </div>

        <div class="order-confirm__button">
            {{-- 購入確定はPOSTで --}}
            <form action="{{ route('orders.checkout', $item) }}" method="POST">
                @csrf
                <button type="submit" class="order-confirm__button--submit">購入を確定する</button>
            </form>
            <a href="{{ route('items.show', $item) }}" class="order-confirm__button--back">← 詳細に戻る</a>
        </div>
    </div>
@endsection
