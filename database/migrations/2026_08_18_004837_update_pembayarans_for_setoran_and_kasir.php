<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->decimal('uang_diterima', 15, 2)->default(0)->after('nominal');
            $table->decimal('kembalian', 15, 2)->default(0)->after('uang_diterima');
            $table->string('metode_pembayaran')->default('tunai')->after('kembalian');
            $table->foreignId('setoran_id')->nullable()->after('petugas_id')->constrained('setorans')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropForeign(['setoran_id']);
            $table->dropColumn(['uang_diterima', 'kembalian', 'metode_pembayaran', 'setoran_id']);
        });
    }
};
