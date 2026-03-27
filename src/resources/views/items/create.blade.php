@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection
@section('content')

<div class="item__content">
        <div class="item__section">
            <div class="section__title">
                <h3>商品出品</h3>
                <a href="{{ route('items.index') }}" class="section__button-back">
                    ← 一覧に戻る
                </a>
            </div>
        </div>
        <form action="{{ route('items.store') }}" method="post" class="add-form" enctype="multipart/form-data">
            @csrf
            <div class="add-form__content">
                <div class="add-form__item">
                    <label for="name" class="add-form__label">商品名</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }} "class="add-form__input">
                </div>
                <div class="add-form__item">
                    <label for="price" class="add-form__label">金額</label>
                    <input type="text" id="price" name="price" value="{{ old('price') }} "class="add-form__input">
                </div>
                <div class="add-form__item">
                    <label for="category" class="add-form__label">カテゴリー</label>
                    <select name="category_id" class="add-form__select" id="category">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"{{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-form__item">
                    <label for="condition" class="add-form__label">状態</label>
                    <select name="condition_id" class="add-form__select" id="condition">
                        <option value="">選択してください</option>
                        @foreach ($conditions as $condition)
                            <option value="{{ $condition->id }}"{{ old('condition_id') == $condition->id ? 'selected' : '' }}>{{ $condition->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-form__item">
                    <label for="description" class="add-form__label">説明文</label>
                    <textarea name="description" id="description" rows="5" class="add-form__textarea">{{ old('description') }}</textarea>
                </div>
                <div class="add-form__item">
                    <label for="image" class="add-form__label">画像</label>
                    <input type="file" name="image" id="image">
                </div>
            </div>
            <div class="add-form__button">
                <button class="add-form__button--submit" type="submit">出品する</button>
            </div>
        </form>
    </div>
