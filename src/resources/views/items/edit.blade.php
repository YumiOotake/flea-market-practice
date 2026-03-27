@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection
@section('content')

<div class="item__content">
        <div class="item__section">
            <div class="section__title">
                <h3>商品編集</h3>
                <a href="{{ route('items.mypage') }}" class="section__button-back">
                    ← マイページに戻る
                </a>
            </div>
        </div>
        <form action="{{ route('items.update', $item) }}" method="post" class="edit-form" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="edit-form__content">
                <div class="edit-form__item">
                    <label for="name" class="edit-form__label">商品名</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}"class="edit-form__input">
                </div>
                <div class="edit-form__item">
                    <label for="price" class="edit-form__label">金額</label>
                    <input type="text" id="price" name="price" value="{{ old('price', $item->price) }}"class="edit-form__input">
                </div>
                <div class="edit-form__item">
                    <label for="category" class="edit-form__label">カテゴリー</label>
                    <select name="category_id" class="edit-form__select" id="category">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"{{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="edit-form__item">
                    <label for="condition" class="edit-form__label">状態</label>
                    <select name="condition_id" class="edit-form__select" id="condition">
                        <option value="">選択してください</option>
                        @foreach ($conditions as $condition)
                            <option value="{{ $condition->id }}"{{ old('condition_id', $item->condition_id) == $condition->id ? 'selected' : '' }}>{{ $condition->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="edit-form__item">
                    <label for="description" class="edit-form__label">説明文</label>
                    <textarea name="description" id="description" rows="5" class="edit-form__textarea">{{ old('description', $item->description) }}</textarea>
                </div>
                <div class="edit-form__item">
                    <label for="image" class="edit-form__label">画像</label>
                    <img src="{{ asset('storage/' . $item->image) }}" alt="item image">
                    <input type="file" name="image" id="image">
                </div>
            </div>
            <div class="edit-form__button">
                <button class="edit-form__button--submit" type="submit">編集する</button>
            </div>
        </form>
    </div>
