<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodeasset',
        'namaasset',
        'tglbeli',
        'hrgbeli',
        'aktif',
    ];

    public function assetMasuk()
    {
        return $this->hasMany(AssetMasuk::class, 'kodeasset', 'kodeasset');
    }
}
