<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Dashboard extends Model
{
    final public function charts(): HasMany
    {
        return $this->hasMany(Chart::class);
    }

    final public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
