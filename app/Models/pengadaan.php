<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang sesuai dengan CDM
    protected $table = 'pengadaan';

    // Primary key tabel bertipe BIGINT
    protected $primaryKey = 'idpengadaan';

    // Karena idpengadaan bersifat auto-incrementing integer (BIGINT)
    public $incrementing = true;
    protected $keyType = 'int';

    // Tabel menggunakan kolom 'timestamp' kustom, bukan 'created_at' dan 'updated_at' bawaan Laravel
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'timestamp',
        'user_iduser',
        'status',
        'vendor_idvendor',
        'subtotal_nilai',
        'ppn',
        'total_nilai',
    ];

    // Konversi tipe data otomatis (Casting)
    protected $casts = [
        'timestamp'      => 'datetime',
        'subtotal_nilai' => 'integer',
        'ppn'            => 'integer',
        'total_nilai'    => 'integer',
    ];

    // ==========================================
    // RELASI ELOQUENT (RELATIONSHIPS)
    // ==========================================

    /**
     * Relasi ke Vendor (Many to One)
     * Setiap transaksi pengadaan ditujukan ke satu vendor.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_idvendor', 'idvendor');
    }

    /**
     * Relasi ke User (Many to One)
     * Transaksi pengadaan dicatat/dibuat oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_iduser', 'iduser');
    }

    /**
     * Relasi ke Detail Pengadaan (One to Many)
     * Satu pengadaan dapat memiliki banyak item barang yang dipesan.
     */
    public function detailPengadaan()
    {
        return $this->hasMany(DetailPengadaan::class, 'idpengadaan', 'idpengadaan');
    }

    /**
     * Relasi ke Penerimaan (One to Many)
     * Satu pengadaan bisa diterima dalam satu atau beberapa transaksi penerimaan.
     */
    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'idpengadaan', 'idpengadaan');
    }
}