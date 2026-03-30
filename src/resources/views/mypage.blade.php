@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection
@section('content')
    <div class="item__content">
        <div class="item__heading">
            <h2 class="heading-ttl item__heading-ttl">マイページ</h2>
        </div>
        <a href="{{ route('items.index') }}" class="section__button-back">
            ← 一覧に戻る
        </a>
        <aside class="sidebar">
            <section class="sidebar-profile">
                <p class="sidebar-profile__name">{{ $user->name }}</p>
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="" class="sidebar-profile__image">
                <p class="sidebar-profile__email">{{ $user->email }}</p>
            </section>
        </aside>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        <div class="item__create">
            <a href="{{ route('items.create') }}" class="item__create--link">出品する</a>
        </div>

        {{-- @if (Auth::id() == $item->seller_id) --}}
        <div class="order-list__header">
            <h3 class="order-list__title">出品一覧</h3>
        </div>
        @forelse ($items as $item)
            <div class="item-card">
                <figure class="item-card__figure">
                    <div class="item-card__image">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="" class="item-card__image--img">
                    </div>
                    <figcaption class="item-card__figcaption">
                        <h3 class="item-card__figcaption--title">{{ $item->name }}</h3>
                        <p class="item-card__figcaption--price">{{ $item->price }}</p>
                        <p class="item-card__figcaption--status">{{ $item->status_label }}</p>
                        <p class="item-card__figcaption--status">{{ $item->condition->name }}</p>
                    </figcaption>
                </figure>
                <div class="item-card__button">
                    @can('update', $item)
                        <div class="item-card__button-edit">
                            <a href="{{ route('items.edit', $item) }}" class="item-card__button--edit">編集</a>
                        </div>
                    @endcan
                    @can('delete', $item)
                        <form action="{{ route('items.destroy', $item) }}" method="POST" class="item-card__form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="item-card__button--delete">
                                出品を取り消す
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        @empty
            <p>出品中の商品はありません</p>
        @endforelse


        {{-- @if (Auth::id() == $order->buyer_id) --}}
        <div class="order-list__header">
            <h3 class="order-list__title">購入履歴</h3>
        </div>
        @forelse ($orders as $order)
            <div class="item-card">
                <figure class="item-card__figure">
                    <div class="item-card__image">
                        <img src="{{ asset('storage/' . $order->item->image) }}" alt=""
                            class="item-card__image--img">
                    </div>
                    <figcaption class="item-card__figcaption">
                        <h3 class="item-card__figcaption--title">{{ $order->item->name }}</h3>
                        <p class="item-card__figcaption--price">{{ $order->item->price }}</p>
                        <p class="item-card__figcaption--status">{{ $order->status_label }}</p>
                    </figcaption>
                </figure>
                <div class="item-card__review">
                    @if ($order->review)
                        <span class="item-card__review-done">レビュー済み ⭐️{{ $order->review->rating }}</span>
                    @else
                        <a href="{{ route('reviews.create', $order) }}" class="item-card__review-button">レビューを書く</a>
                    @endif
                </div>
            </div>
        @empty
            <p>購入履歴はありません</p>
        @endforelse

    </div>
@endsection
