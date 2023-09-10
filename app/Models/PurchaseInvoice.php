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



}
