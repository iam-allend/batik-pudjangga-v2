<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',
        'subcategory',
        'image',
        'is_new',
        'is_sale',
        'is_preorder',
        'preorder_duration',
        'available_sizes',
        'sale_price',
        'sale_start',
        'sale_end',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'stock' => 'integer',
        'is_new' => 'boolean',
        'is_sale' => 'boolean',
        'is_preorder' => 'boolean',
        'sale_start' => 'date',
        'sale_end' => 'date',
    ];

    // Relationships
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Scopes
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOnSale($query)
    {
        return $query->where('is_sale', true)
            ->whereNotNull('sale_price')
            ->where(function($q) {
                $q->whereNull('sale_start')
                  ->orWhere('sale_start', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('sale_end')
                  ->orWhere('sale_end', '>=', now());
            });
    }

    // FIX: Rename dari 'new()' ke 'newProducts()' karena 'new' adalah reserved keyword
    public function scopeNewProducts($query)
    {
        return $query->where('is_new', true);
    }

    public function scopePreorder($query)
    {
        return $query->where('is_preorder', true);
    }

    public function scopeReadyStock($query)
    {
        return $query->where('is_preorder', false)
            ->where('stock', '>', 0);
    }

    public function scopeInStock($query)
    {
        return $query->where(function($q) {
            $q->where('is_preorder', true)
              ->orWhere('stock', '>', 0);
        });
    }

    // Accessors
    public function getCurrentPriceAttribute()
    {
        if ($this->is_sale && $this->sale_price && $this->isOnSaleNow()) {
            return $this->sale_price;
        }
        return $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->is_sale && $this->sale_price && $this->price > 0) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    public function getAvailableSizesArrayAttribute()
    {
        return json_decode($this->available_sizes, true) ?? [];
    }

    public function getEstimatedDeliveryAttribute()
    {
        if ($this->is_preorder && $this->preorder_duration) {
            return Carbon::now()->addDays($this->preorder_duration)->format('d M Y');
        }
        return 'Ready to ship';
    }

    // Helper Methods
    public function isOnSaleNow()
    {
        if (!$this->is_sale || !$this->sale_price) {
            return false;
        }

        $now = now();

        if ($this->sale_start && $now->lt($this->sale_start)) {
            return false;
        }

        if ($this->sale_end && $now->gt($this->sale_end)) {
            return false;
        }

        return true;
    }

    public function hasSize($size)
    {
        return in_array($size, $this->available_sizes_array);
    }

    public function isAvailable()
    {
        return $this->is_preorder || $this->stock > 0;
    }

    public function getStockStatus()
    {
        if ($this->is_preorder) {
            return 'preorder';
        }
        
        if ($this->stock <= 0) {
            return 'out_of_stock';
        }
        
        if ($this->stock <= 5) {
            return 'low_stock';
        }
        
        return 'in_stock';
    }
}