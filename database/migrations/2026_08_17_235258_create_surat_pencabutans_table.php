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
        Schema::create('surat_pencabutans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->cascadeOnDelete();
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->decimal('total_tunggakan', 15, 2);
            $table->integer('jumlah_bulan');
            $table->enum('status', ['draft', 'dicabut', 'batal'])->default('draft');
            $table->foreignId('dibuat_oleh')->constrained('users')->cascadeOnDelete();
            $table->date('diberikan_pada')->nullable();
            $table->string('bukti_pencabutan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pencabutans');
    }
};
