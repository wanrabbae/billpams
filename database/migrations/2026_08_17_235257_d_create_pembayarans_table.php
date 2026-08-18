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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->cascadeOnDelete();
            $table->foreignId('tagihan_id')->constrained('tagihans')->cascadeOnDelete();
            $table->string('nomor_kwitansi')->unique();
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal');
            $table->foreignId('petugas_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['valid', 'void'])->default('valid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
