<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QrCode extends Model
{
    use HasFactory, Loggable, SoftDeletes;

    public $fillable = [
        'category_id',
        'qr_code',
        'title',
        'description',
        'floor',
        'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
