@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth-common.css') }}">
@endsection
@section('content')
    <div class="auth-form__content">
        <div class="auth-form__heading">
            <h2 class="auth-form__heading-ttl">パスワード再設定</h2>
        </div>
        <form method="POST" action="{{ route('password.update') }}" class="auth-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request()->email }}">
            <div class="auth-form__group">
                <div class="auth-form__group-title">
                    <label for="password" class="auth-form__label">新しいパスワード</label>
                </div>
                <div class="auth-form__group-content">
                    <input type="password" id="password" name="password" class="auth-form__input">
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
            <div class="auth-form__button">
                <button class="auth-form__button-submit">パスワード変更</button>
            </div>
        </form>
    </div>
@endsection
