<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
      "sell_id",
      "product_id",
      "quantity",
      "value",
      "discount"
    ];

    public function sell(){
        return $this->belongsTo(Sell::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
