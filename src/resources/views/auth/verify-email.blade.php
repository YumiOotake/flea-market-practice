<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール認証</title>
</head>
<body>
    <h1>メール認証してください</h1>

    <p>登録したメールアドレスに認証リンクを送っています。</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">認証メールを再送</button>
    </form>
</body>
</html>
