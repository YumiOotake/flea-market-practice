@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth-common.css') }}">
@endsection
@section('content')
    <div class="auth-form__content">
        <div class="auth-form__heading">
            <h2 class="auth-form__heading-ttl">Login</h2>
        </div>
        <form action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf
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
                <div class="auth-form__forgot">
                    <a href="{{ route('password.request') }}" class="auth-form__forgot-link">パスワードをお忘れですか？</a>
                </div>
            </div>
            <div class="auth-form__button">
                <button class="auth-form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
@endsection
