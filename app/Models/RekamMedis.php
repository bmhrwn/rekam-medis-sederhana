<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekamMedis extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "rekam_medis";
    protected $fillable = [
        "no_rekam_medis",
        "patient_id",
        "dokter_id",
        "diagnosa",
        "harga",
        "regist_date",
        "status",
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
