@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth/auth-common.css') }}">
@endsection
@section('content')
    <div class="auth-form__content">
        <div class="auth-form__heading">
            <h2 class="auth-form__heading-ttl">メール認証</h2>
        </div>
        <div class="auth-form__notice">
            <p class="auth-form__notice-text">
                登録したメールアドレスに認証リンクを送信しました。<br>
                メールを確認して認証を完了してください。
            </p>
        </div>
        <form method="POST" action="{{ route('verification.send') }}" class="auth-form">
            @csrf
            <div class="auth-form__button">
                <button type="submit" class="auth-form__button-submit">認証メールを再送する</button>
            </div>
        </form>
    </div>
@endsection
