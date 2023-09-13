<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'purchase_invoices';
    protected $fillable = ['date','date_echeance','type','supplier_id','etat_paiement','moyen_paiement','no_cheque','no_virement'];


    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function purchaseItems(): HasMany
    {
        return $this->hasMany(PurchaseItem::class,'invoice_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($invoice) {
            $invoice->purchaseItems()->delete();
        });


        static::forceDeleting(function ($invoice) {
            $orders = $invoice->purchaseItems;

            foreach ($orders as $order) {
                if (!is_null($order->product_id)) {
                    $product = $order->product;
                    $product->stock -= $order->quantite;
                    $product->save();
                }
            }

            $invoice->purchaseItems()->forceDelete();
        });

        static::restored(function ($invoice) {
            $invoice->purchaseItems()->onlyTrashed()->restore();
        });



}
}
