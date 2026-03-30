@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/review-create.css') }}">
@endsection
@section('content')
    <div class="review__content">
        <div class="review__heading">
            <h2 class="heading-ttl review__heading-ttl">レビューを書く</h2>
        </div>
        <a href="{{ route('mypage') }}" class="section__button-back">← マイページに戻る</a>

        {{-- 取引情報 --}}
        <div class="review__item-card">
            <div class="review__item-image">
                <img src="{{ asset('storage/' . $order->item->image) }}" alt="" class="review__item-image--img">
            </div>
            <div class="review__item-info">
                <p class="review__item-name">{{ $order->item->name }}</p>
                <p class="review__item-price">{{ number_format($order->item->price) }}円</p>
                <p class="review__item-seller">出品者：{{ $order->seller->name }}</p>
            </div>
        </div>

        {{-- レビューフォーム --}}
        <form action="{{ route('reviews.store', $order) }}" method="POST" class="review-form">
            @csrf

            {{-- 星評価 --}}
            <div class="review-form__group">
                <label class="review-form__label">評価</label>
                <div class="star-rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                            class="star-rating__input"
                            {{ old('rating') == $i ? 'checked' : '' }}>
                        <label for="star{{ $i }}" class="star-rating__label">★</label>
                    @endfor
                </div>
                @error('rating')
                    <p class="review-form__error">{{ $message }}</p>
                @enderror
            </div>

            {{-- コメント --}}
            <div class="review-form__group">
                <label for="comment" class="review-form__label">コメント（任意）</label>
                <textarea name="comment" id="comment" rows="5"
                    class="review-form__textarea"
                    placeholder="取引について感想を書いてください">{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="review-form__error">{{ $message }}</p>
                @enderror
            </div>

            <div class="review-form__button">
                <button type="submit" class="review-form__button--submit">レビューを投稿する</button>
            </div>
        </form>
    </div>
@endsection
