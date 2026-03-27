@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/detail.css') }}">
@endsection
@section('content')
    <div class="detail__content">
        <div class="detail__heading">
            <h2 class="heading-ttl detail__heading-ttl">商品詳細</h2>
        </div>
        <div class="section__button">
            <a href="{{ route('items.index') }}" class="section__button-back">
                ← 一覧に戻る
            </a>
        </div>
        <div class="item-detail">
            <div class="item-detail__item">
                <img src="{{ asset('storage/' . $item->image) }}" alt="item image">
            </div>
            <div class="item-detail__item">
                <span class="item-detail__title">商品名</span>
                <p class="item-detail__text">{{ $item->name }}</p>
            </div>
            <div class="item-detail__item">
                <span class="item-detail__title">カテゴリ</span>
                <p class="item-detail__text">{{ $item->category->name }}</p>
            </div>
            <div class="item-detail__item">
                <p class="item-detail__text">{{ $item->description }}</p>
            </div>

            <div class="item-detail__item">
                <span class="item-detail__title">金額</span>
                <p class="item-detail__text">{{ $item->price }}円</p>
            </div>

            <div class="item-detail__item">
                <span class="item-detail__title">状態</span>
                <p class="item-detail__text">{{ $item->condition->name }}</p>
            </div>

            <div class="item-detail__item">
                <span class="item-detail__title">登録日</span>
                <p class="item-detail__text">{{ $item->created_at->format('Y年m月d日') }}</p>
            </div>
        </div>
        <div class="item-detail__button">
            @auth
                <a href="{{ route('items.store', $item) }}" class="item-detail__button--edit">
                    購入する
                </a>
            @else
                <a href="{{ route('login') }}">ログインして購入する</a>
            @endauth



        </div>

    </div>
@endsection
