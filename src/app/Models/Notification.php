<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'item_id',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getMessageAttribute(): string
    {
        return match($this->type) {
            'order_created' => "「{$this->item->name}」が購入されました",
            'order_shipped' => "購入した「{$this->item->name}」が発送されました",
            'order_received' => "「{$this->item->name}」が受取完了になりました",
            'order_created' => "レビューが投稿されました",
        };
    }

    public function getLinkAttribute(): string
    {
        return match ($this->type) {
            'order_created' => route('mypage'),
            'order_shipped' => route('mypage'),
            'order_received' => route('mypage'),
            'order_created' => route('mypage'),
        };
    }
}
