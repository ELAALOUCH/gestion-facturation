<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('numero');
            $table->enum('type', ['tva', 'ttc','exonéré']);
            $table->enum('type_produit', ['service', 'produit']);
            $table->date('date');
            $table->date('date_echeance');
            $table->unsignedInteger('tva');
            $table->decimal('total_ht',20,2);
            $table->decimal('total_tva',20,2);
            $table->string('etat_paiement');
            $table->string('moyen_paiement')->nullable();
            $table->string('no_cheque')->nullable();
            $table->string('no_virement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
