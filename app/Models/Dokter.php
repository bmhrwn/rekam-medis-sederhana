<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "dokters";

    protected $fillable = [
        "name",
        "no_ktp",
        "gender",
        "spesialis",
        "phone",
        "address",
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
