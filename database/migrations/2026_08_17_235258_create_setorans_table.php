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
        Schema::create('setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('petugas_id')->constrained('users')->cascadeOnDelete();
            $table->date('tanggal');
            $table->integer('jumlah_transaksi');
            $table->decimal('total_penerimaan', 15, 2);
            $table->decimal('total_setoran', 15, 2);
            $table->decimal('selisih', 15, 2)->default(0);
            $table->enum('status', ['belum_disetor', 'menunggu_konfirmasi', 'diterima', 'ada_selisih'])->default('belum_disetor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setorans');
    }
};
