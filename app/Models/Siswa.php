<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $primaryKey = 'nis';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $guarded = ['id'];

    protected $fillable = [
        'nis',
        'username',
        'nama_siswa',
        'kelas',
        'no_hp',
        'password',
    ];

    public function siswa(): HasMany
    {
        return $this->pengaduan();
    }

    public function pengaduan(): HasMany
    {
        return $this->hasMany(Pengaduan::class, 'siswa_nis', 'nis');
    }
}