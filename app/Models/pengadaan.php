<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    protected $table = 'pengadaan';
    protected $primaryKey = 'idpengadaan';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'timestamp',
        'iduser',
        'status',
        'vendor_idvendor',
        'subtotal_nilai',
        'ppn',
        'total_nilai',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'subtotal_nilai' => 'integer',
        'ppn' => 'integer',
        'total_nilai' => 'integer',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_idvendor', 'idvendor');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function detailPengadaan()
    {
        return $this->hasMany(DetailPengadaan::class, 'idpengadaan', 'idpengadaan');
    }

    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'idpengadaan', 'idpengadaan');
    }
}