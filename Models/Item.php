<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'start_price', 'description', 'date'
    ];

    public function auction()
    {
        return $this->hasOne(Auction::class, 'item_id', 'id');
    }
}