<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'invoices';

    protected $casts = [
        'customer_id' => 'integer',
        'amount' => 'float',
        'billed_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    protected $fillable = [
        'customer_id',
        'amount',
        'status',
        'billed_at',
        'paid_at',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'invoices_products', 'invoice_id', 'product_id');
    }
}
