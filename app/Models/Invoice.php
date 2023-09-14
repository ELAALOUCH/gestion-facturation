<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['numero','customer_id','type','date','date_echeance','tva','total_ht','total_tva','type_produit','etat_paiement','moyen_paiement','no_cheque','no_virement'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($invoice) {
            $invoice->orders()->delete();
        });


        static::forceDeleting(function ($invoice) {
            $orders = $invoice->orders;

            foreach ($orders as $order) {
                if (!is_null($order->product_id)) {
                    $product = $order->product;
                    $product->stock += $order->quantite;
                    $product->save();
                }
            }

            $invoice->orders()->forceDelete();
        });

        static::restored(function ($invoice) {
            $invoice->orders()->onlyTrashed()->restore();
            $invoice->customer()->restore();
        });
    }


}
