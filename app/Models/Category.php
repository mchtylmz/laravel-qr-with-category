<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Pharaonic\Laravel\Images\HasImages;
use Zoha\Metable;

/**
 *
 */
class Category extends Model
{
    use HasFactory, Loggable, SoftDeletes;

    /**
     * @var string[]
     */
    public $fillable = [
        'name',
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function qrcode(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(QrCode::class);
    }
}
