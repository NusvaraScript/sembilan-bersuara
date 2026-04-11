<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tanggapan extends Model
{
    //
    protected $table = "tanggapan";
    protected $fillable = ['pengaduan_id', 'petugas_id', 'isi_tanggapan'];

    public function pengaduan(): BelongsTo {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    public function petugas(): BelongsTo {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
