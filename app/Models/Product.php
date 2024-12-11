<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Product extends Model implements Searchable

{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image','cost_price','quantity','category_id'];
    protected $table = "products"; 
    protected $primaryKey= 'id';

    // protected $casts = [
    //     'image' => 'array', 
    // ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderitem()
    {
        return $this->HasMany(OrderItem::class);
    }
    public function getSearchResult(): SearchResult
    {
        $url = route('products.show', $this->id);

        return new SearchResult(
            $this,
            $this->name,
           $url
        );
    }
}
