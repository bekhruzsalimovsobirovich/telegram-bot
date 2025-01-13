<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appeal extends Model
{
    use HasFactory;

    protected $fillable = ['people_id','text'];

    public function people(): BelongsTo
    {
        return $this->belongsTo(People::class)->withTrashed();
    }
}
