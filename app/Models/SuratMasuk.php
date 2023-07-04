<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
            'no_urut',
            'dari_instansi',
            'no_surat',
            'perihal',
            'tanggal_surat',
            'tanggal_terima',
            'kepada',
            'kategori_surat',
            'isi_disposisi',
            'status',
            'lampiran',
            'tindakan',
            'jabatan_bidang_id',
            'karyawan_id',
            'tindakan_kadin',
            'catatan_kadin',
            'tanggal_penyelesaian',
            'tanggal_konfirmasi_admin1',
            'tanggal_konfirmasi_admin2',
            'tanggal_konfirmasi_admin3',
    ];

    public function jabatan_bidang()
    {
        return $this->belongsTo(JabatanBidang::class, 'jabatan_bidang_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
    
}
