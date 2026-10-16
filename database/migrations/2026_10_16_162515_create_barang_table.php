<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel barang sudah ada, jadi tidak perlu dibuat ulang.
        if (!Schema::hasTable('barang')) {
            Schema::create('barang', function (Blueprint $table) {
                $table->increments('idbarang');
                $table->char('jenis', 1)->nullable();
                $table->string('nama', 45)->nullable();
                $table->integer('idsatuan')->nullable();
                $table->tinyInteger('status')->nullable();
                $table->integer('harga')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Tidak menghapus tabel barang yang sudah ada.
    }
};
