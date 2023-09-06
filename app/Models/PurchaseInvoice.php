<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseInvoice extends Model
{
    use HasFactory;

    protected $table = 'purchase_invoices';
    protected $fillable = ['date','date_echeance','type','supplier_id','etat_paiement','moyen_paiement','no_cheque','no_virement'];


    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
