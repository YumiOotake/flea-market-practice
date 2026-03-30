@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth-common.css') }}">
@endsection
@section('content')
    <div class="auth-form__content">
        <div class="auth-form__heading">
            <h2 class="auth-form__heading-ttl">パスワードをお忘れの方</h2>
        </div>
        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf
            <div class="auth-form__group">
                <div class="auth-form__group-title">
                    <label for="email" class="auth-form__label">メールアドレス</label>
                </div>
                <div class="auth-form__group-content">
                    <input type="email" id="email" name="email"
                        class="auth-form__input" placeholder="例: test@example.com">
                </div>
                <div class="auth-form__error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="auth-form__button">
                <button type="submit" class="auth-form__button-submit">送信</button>
            </div>
        </form>
    </div>
@endsection
