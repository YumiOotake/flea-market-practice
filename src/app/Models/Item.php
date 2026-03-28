<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'category_id',
        'condition_id',
        'name',
        'description',
        'image',
        'price',
        'status',
    ];

    protected $casts = [
        'price' => 'integer',
        'status' => 'integer',
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            1 => '販売中',
            2 => '売り切れ',
            default => '販売中'
        };
    }
}
