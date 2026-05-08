<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Petugas extends Authenticatable
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

    protected $hidden = [
        'password',
        'remember_token',
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
