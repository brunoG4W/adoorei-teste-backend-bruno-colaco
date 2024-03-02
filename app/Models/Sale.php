<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Sale extends Model
{
    use HasFactory;

    protected $primaryKey = 'sales_id';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale', 'sale_id', 'product_id');
    }
    
}
