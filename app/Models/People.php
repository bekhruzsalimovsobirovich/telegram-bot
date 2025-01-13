<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'chat_id',
        'name',
        'username',
        'phone'
    ];

    public function appeals(): HasMany
    {
        return $this->hasMany(Appeal::class);
    }
}
