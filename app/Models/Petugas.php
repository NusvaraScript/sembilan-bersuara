<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    //
    protected $table = "petugas";
    protected $keyType = 'int';
    protected $guarded = ['id'];
    protected $fillable = [
        'username', 
        'nama_petugas', 
        'level', 
        'password'
    ];

    public function petugas()
    {
        return $this->hasMany(Pengaduan::class, 'petugas_id', 'id');
    }
}
