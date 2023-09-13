<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['invoice_id','product_id','service_id','quantite','prix'];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
