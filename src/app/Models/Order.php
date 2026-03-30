<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'buyer_id',
        'seller_id',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    //役割ごとに分ける
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            1 => '購入済み',
            2 => '発送済み',
            3 => '受け取り完了',
            default => '購入済み',
        };
    }
}
