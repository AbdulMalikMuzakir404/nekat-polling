<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calon extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['foto_calon'];

    public function getFotoCalonAttribute()
    {
        return $this->getMedia('foto_calon')->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function polling()
    {
        return $this->hasMany(Polling::class);
    }
}
