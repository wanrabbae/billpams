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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->string('kode_pelanggan');
            $table->string('nama');
            $table->text('alamat');
            $table->enum('status', ['aktif', 'nonaktif', 'dicabut'])->default('aktif');
            $table->enum('jenis_pelanggan', ['umum', 'sosial', 'industri'])->default('umum');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->unique(['tenant_id', 'kode_pelanggan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
