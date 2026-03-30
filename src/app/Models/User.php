<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Review;

//「このユーザーはメール認証必要です」と宣言
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'seller_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    // 必要になったら追加、必要になる場面は「自分が売った注文一覧」を表示したいとき
    // public function soldOrders()
    // {
    //     return $this->hasMany(Order::class, 'seller_id');
    // }

    // → マイページで「自分が書いたレビュー一覧」を表示したいなら必要
    // public function givenReviews()
    // {
    //     return $this->hasMany(Review::class, 'reviewer_id');
    // }

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id');
    }

    public function getAverageRatingAttribute(): string
    {
        $avg = $this->receivedReviews()->avg('rating');
        return $avg ? number_format($avg, 1) : '未評価';
    }

    public function getReviewsCountAttribute(): int
    {
        return $this->receivedReviews()->count();
    }
}
