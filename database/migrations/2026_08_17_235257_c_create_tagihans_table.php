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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->cascadeOnDelete();
            $table->string('periode');
            $table->integer('meter_awal');
            $table->integer('meter_akhir');
            $table->integer('pemakaian');
            $table->decimal('tarif', 10, 2);
            $table->decimal('subsidi', 10, 2)->default(0);
            $table->decimal('total', 15, 2);
            $table->enum('status', ['belum_bayar', 'sebagian', 'lunas', 'void'])->default('belum_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
