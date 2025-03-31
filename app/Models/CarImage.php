<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarImage extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['image_path', 'position'];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

}
