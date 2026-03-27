@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/items/index.css') }}">
@endsection
@section('content')
    <div class="item__content">
        <div class="item__heading">
            <h2 class="heading-ttl item__heading-ttl">商品一覧ページ</h2>
        </div>

        
        {{-- <form class="search-form" action="{{ route('contacts.search') }}" method="get">
            <div class="search-form__content">
                <div class="search-form__item">
                    <input type="text" name="keyword" class="search-form__item-input" placeholder="名前やメールアドレスを入力してください "
                        value="{{ request('keyword') }}">
                </div>
                <div class="search-form__item">
                    <select name="gender" class="search-form__item-input">
                        <option value="">性別</option>
                        <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>全て</option>
                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="search-form__item">
                    <select name="category_id" class="search-form__item-input">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="search-form__item">
                    <input type="date" id="date" name="date" class="search-form__item-input" placeholder="年/月/日">
                </div>
                <div class="search-form__button">
                    <button class="search-form__button--submit" type="submit">検索</button>
                    <a href="{{ route('contacts.admin') }}" class="search-form__button--reset">
                        リセット
                    </a>
                </div>
            </div>
        </form>
        <div class="admin-content__nav">
            <div class="admin-content__export">
                <a href="" class="admin-content__export--button">エクスポート</a>
            </div>
            <div class="admin-content__paginate">
                {{ $contacts->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div> --}}

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
                    <a href="{{ route('items.detail', $item) }}" class="item-card__link-button">商品詳細</a>
                </div>
            </div>
        @empty
        @endforelse
    </div>
@endsection
