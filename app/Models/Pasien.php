<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "pasiens";
    protected $fillable = [
        "name",
        "no_ktp",
        "gender",
        "dob",
        "phone",
        "address",
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
