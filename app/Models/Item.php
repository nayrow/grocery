<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $id)
 * @method static create(array $array)
 */
class Item extends Model
{
    protected $fillable = ['user_id','name', 'quantity','checked','bought'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
