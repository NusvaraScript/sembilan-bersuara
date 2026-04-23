<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $table = "siswa";
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
        'password'
    ];
}
