<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    //
    protected $table = "pengaduan";
    protected $fillable = ['kategori_id', 'siswa_nis', 'judul_laporan', 'isi_laporan', 'foto', 'status'];

    public function kategori(): BelongsTo {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function siswa(): BelongsTo {
        return $this->belongsTo(Siswa::class, 'siswa_nis', 'nis');
    }
}
