@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/index.css') }}">
@endsection
@section('content')
    <div class="item__content">
        <div class="item__heading">
            <h2 class="heading-ttl item__heading-ttl">商品一覧ページ</h2>
            <a href="{{ route('mypage') }}" class="section__button-back">
                マイページへ
            </a>
        </div>


        <form class="search-form" action="{{ route('items.search') }}" method="get">
            <div class="search-form__content">
                <div class="search-form__item">
                    <input type="text" name="keyword" class="search-form__item-input" placeholder="商品名を入力してください "
                        value="{{ request('keyword') }}">
                </div>
                <div class="search-form__item">
                    <select name="status" class="search-form__item-input">
                        <option value="">販売状況</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>販売中</option>
                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>売り切れ</option>
                    </select>
                </div>
                <div class="search-form__item">
                    <select name="category_id" class="search-form__item-input">
                        <option value="">カテゴリー</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="search-form__button">
                    <button class="search-form__button--submit" type="submit">検索</button>
                    <a href="{{ route('items.index') }}" class="search-form__button--reset">
                        リセット
                    </a>
                </div>
            </div>
        </form>
        <div class="admin-content__nav">
            <div class="admin-content__paginate">
                {{ $items->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
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
                <div class="item-card__link">
                    <a href="{{ route('items.show', $item) }}" class="item-card__link-button">商品詳細</a>
                </div>
            </div>
        @empty
            <p class="item__empty">商品が見つかりませんでした</p>
        @endforelse
        <div class="admin-content__nav">
            <div class="admin-content__paginate">
                {{ $items->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
