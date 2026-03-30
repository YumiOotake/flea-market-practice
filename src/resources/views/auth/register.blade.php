@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth-common.css') }}">
@endsection
@section('content')
    <div class="auth-form__content">
        <div class="auth-form__heading">
            <h2 class="auth-form__heading-ttl">Register</h2>
        </div>
        <form action="{{ route('register') }}" method="POST" class="auth-form" enctype="multipart/form-data">
            @csrf
            <div class="auth-form__group">
                <div class="auth-form__group-title">
                    <label for="name" class="auth-form__label">お名前</label>
                </div>
                <div class="auth-form__group-content">
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="auth-form__input" placeholder="例: 山田 太郎">
                </div>
                <div class="auth-form__error">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="auth-form__group">
                <div class="auth-form__group-title">
                    <label for="email" class="auth-form__label">メールアドレス</label>
                </div>
                <div class="auth-form__group-content">
                    <input type="text" id="email" name="email" value="{{ old('email') }}"
                        class="auth-form__input" placeholder="例: test@example.com">
                </div>
                <div class="auth-form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="auth-form__group">
                <div class="auth-form__group-title">
                    <label for="password" class="auth-form__label">パスワード</label>
                </div>
                <div class="auth-form__group-content">
                    <input type="password" id="password" name="password"
                        class="auth-form__input" placeholder="例: coachtech1106">
                </div>
                <div class="auth-form__error">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="auth-form__group">
                <div class="auth-form__group-title">
                    <label for="confirm-password" class="auth-form__label">確認用パスワード</label>
                </div>
                <div class="auth-form__group-content">
                    <input type="password" name="password_confirmation" id="confirm-password"
                        class="auth-form__input">
                </div>
            </div>
            <div class="auth-form__group">
                <div class="auth-form__group-title">
                    <label for="image" class="auth-form__label">プロフィール画像</label>
                </div>
                <div class="auth-form__group-content">
                    <input type="file" name="image" id="image" class="auth-form__file">
                </div>
            </div>
            <div class="auth-form__button">
                <button class="auth-form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
@endsection
