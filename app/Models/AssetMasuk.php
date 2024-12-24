<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetMasuk extends Model
{
    use HasFactory;

    protected $table = 'asset_masuk';
    public $timestamps = false;

    protected $fillable = [
        'kodemasuk',
        'kodeasset',
        'tanggal',
        'qty',
        'hrgtotal',
        'statusmasuk',
        'tgl_input',
    ];



    public function asset()
    {
        return $this->belongsTo(Asset::class, 'kodeasset', 'kodeasset');
    }
}
