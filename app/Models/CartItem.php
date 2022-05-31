<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
  use HasFactory;
	protected $fillable = ['product_id'];
  protected $with = ['products'];	

	public function products()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }	
    
}
