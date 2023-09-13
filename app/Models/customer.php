<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {

            $lastCustomer = Customer::withTrashed()->orderByDesc('code_client')->first();

            if ($lastCustomer) {
                $lastCode = (int) $lastCustomer->code_client;
                $newCode = str_pad($lastCode + 1, 4, '0', STR_PAD_LEFT);
                $customer->code_client = $newCode;
            } else {
                $customer->code_client = '0001';
            }
        });
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
