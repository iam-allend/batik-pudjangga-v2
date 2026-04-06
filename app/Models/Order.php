<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'user_id',
        'recipient_name',
        'address',
        'city',
        'province',
        'postal_code',
        'phone',
        'subtotal',
        'shipping_cost',
        'total_amount',
        'payment_method',
        'payment_proof',
        'payment_proof_uploaded_at',
        'payment_status',
        'shipping_method',
        'resi_code',
        'status',
        'design_status',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'payment_proof_uploaded_at' => 'datetime',
    ];

    // ============================================
    // Relationships
    // ============================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // ============================================
    // Accessors
    // ============================================

    /**
     * Get badge color based on order status
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Get badge color based on design status
     */
    public function getDesignStatusColorAttribute(): string
    {
        return match ($this->design_status) {
            'pending' => 'warning',
            'confirmed' => 'success',
            'rejected' => 'danger',
            default => 'secondary'
        };
    }
    public function getPaymentStatusTextAttribute()
    {
        return [
            'unpaid' => 'Unpaid',
            'pending_verification' => 'Pending Verification',
            'verified' => 'Verified',
            'rejected' => 'Rejected'
        ][$this->payment_status] ?? 'Unknown';
    }

    public function getPaymentStatusColorAttribute()
    {
        return [
            'unpaid' => 'danger',
            'pending_verification' => 'warning',
            'verified' => 'success',
            'rejected' => 'danger'
        ][$this->payment_status] ?? 'secondary';
    }

    /**
     * Get formatted order date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d M Y, H:i');
    }

    /**
     * Get formatted total amount
     */
    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    // ============================================
    // Scopes
    // ============================================

    /**
     * Scope orders by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope pending orders
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope processing orders
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    /**
     * Scope shipped orders
     */
    public function scopeShipped($query)
    {
        return $query->where('status', 'shipped');
    }

    /**
     * Scope completed orders
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope cancelled orders
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope recent orders
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->latest()->limit($limit);
    }

    // ============================================
    // Helper Methods
    // ============================================

    /**
     * Check if order can be cancelled
     */
    public function canBeCancelled(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if order is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if order is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if order is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Get total items count
     */
    public function getTotalItemsAttribute(): int
    {
        return $this->items->sum('quantity');
    }

    public static function generateOrderCode(): string
    {
        do {
            $code = 'BP-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('order_code', $code)->exists());

        return $code;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (!$order->order_code) {
                $order->order_code = 'BP-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }
        });
    }

}

