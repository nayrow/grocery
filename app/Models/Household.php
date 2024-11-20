<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 */
class Household extends Model
{
    protected $fillable = ['name','user_id'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
