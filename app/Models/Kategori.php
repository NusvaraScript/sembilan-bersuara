<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $table = "kategori";
    protected $keyType = 'int';
    protected $guarded = ['id'];
    protected $fillable = [
        'nama_kategori'
    ];

    public function kategori()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id', 'id');
    }
}
