<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Product;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'amount',
    ];

    protected $visible = [
        'id',
        'amount',
        'products',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale', 'sale_id', 'product_id')
                    ->withPivot('amount');
    }
    
}
