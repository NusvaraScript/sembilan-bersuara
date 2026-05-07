<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Petugas extends Model
{
    protected $table = 'petugas';

    protected $keyType = 'int';

    protected $guarded = ['id'];

    protected $fillable = [
        'username',
        'nama_petugas',
        'level',
        'password',
    ];

    public function petugas(): HasMany
    {
        return $this->tanggapan();
    }

    public function tanggapan(): HasMany
    {
        return $this->hasMany(Tanggapan::class, 'petugas_id', 'id');
    }
}
