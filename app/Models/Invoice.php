<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['numero','customer_id','type','date','date_echeance','tva','total_ht','total_tva'];
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
