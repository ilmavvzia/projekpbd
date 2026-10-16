<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('satuan')) {
            Schema::create('satuan', function (Blueprint $table) {
                $table->increments('idsatuan');
                $table->string('nama_satuan', 45)->nullable();
                $table->tinyInteger('status')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Tabel satuan yang sudah ada tidak dihapus.
    }
};