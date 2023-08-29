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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('ice',15);
            $table->string('if',10);
            $table->string('cnss',10);
            $table->string('rib',24);
            $table->string('patente',24);
            $table->string('rc',9);
            $table->string('nom',255);
            $table->string('email',255);
            $table->string('telephone', 255);
            $table->text('adresse');
            $table->string('site_web', 255)->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
