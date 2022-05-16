<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Chart extends Model
{
    protected $casts = [
        'data' => 'array'
    ];

    final public function datasetInfo(): BelongsTo
    {
        return $this->belongsTo(Dataset::class);
    }

    final public function dashboard(): BelongsTo
    {
        return $this->belongsTo(Dashboard::class);
    }
}
