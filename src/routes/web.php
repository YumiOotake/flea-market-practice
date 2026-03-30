<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//「 / にアクセスしたら誰でもログインページに飛ばす」それとログアウト押した時もこのルート　ログインしてる → マイページへ　してない → ログイン画面へ
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('mypage');
    }
    return redirect()->route('login');
});

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/search', [ItemController::class, 'search'])->name('items.search');

//固定パスはワイルドカード（{item}）より必ず前に書く
Route::get('/items/create', [ItemController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('items.create');

Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/mypage', function () {
    //     return view('mypage');
    // })->name('mypage');

    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::patch('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('/items/{item}/order', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::post('/items/{item}/order', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/reviews/{order}/create', [ReviewController::class, 'create'])->name(('reviews.create'));
    Route::post('/reviews/{order}', [ReviewController::class, 'store'])->name(('reviews.store'));

    // Stripe用に変更・追加
    Route::post('/items/{item}/order', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/items/{item}/order/success', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/items/{item}/order/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
});

//メールのURLクリックで表示//未認証の人がアクセスすると表示
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//認証済みにするemail_verified_at に日時入れる
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/mypage');
})->middleware(['auth', 'signed'])->name('verification.verify');

//認証メール再送
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
