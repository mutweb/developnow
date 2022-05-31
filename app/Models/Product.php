<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
  use HasFactory;
  use SoftDeletes;
	protected $fillable = ['name', 'price', 'category_id', 'image'];
  protected $with = ['productCategory'];	

	public function productCategory()
  {
    return $this->belongsTo(ProductCategory::class, 'category_id');
  }

  public function cartItems()
  {
    return $this->hasMany(CartItem::class, 'product_id');
  }

  public function getPriceAttribute($value)
  {
    return number_format( ($value / 100), 2, '.', '' );
  }
  public function setPriceAttribute($value)
  {
    return $this->attributes['price'] = ($value * 100);
  }  
}
