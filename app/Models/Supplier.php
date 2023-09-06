<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function purchaseInvoices(): HasMany
    {
        return $this->hasMany(purchaseInvoices::class,'supplier_id');
    }

}
