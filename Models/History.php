<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'auction_id', 'user_id', 'bid'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function auctions() {
        return $this->belongsTo(Auction::class, 'auction_id', 'id');
    }

    public function items() {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}