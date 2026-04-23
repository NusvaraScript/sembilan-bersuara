<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    //
    protected $table = "petugas";
    protected $guarded = ['id'];
    protected $fillable = [
        'username', 
        'nama_petugas', 
        'level', 
        'password'
    ];
}
