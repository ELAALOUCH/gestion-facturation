<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'purchase_items';
    protected $fillable = ['invoice_id','product_id','service_id','quantite','prix_unitaire'];

    public function purchaseInvoice()
    {
        return $this->belongsTo(purchaseInvoice::class,'invoice_id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($purchaseItem) {
            $purchaseItem->purchaseInvoice()->delete();
        });



        static::restored(function ($purchaseItem) {
            $purchaseItem->purchaseInvoice()->restore();
        });
    }
}
