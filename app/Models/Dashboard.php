<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $dataset_id
 * @property int $user_id
 * @property-read Dataset $dataset
 * @property-read User $user
 */
final class Dashboard extends Model
{
    protected $with = ['dataset'];
    protected $appends = ['chartCount'];

    final public function charts(): HasMany
    {
        return $this->hasMany(Chart::class);
    }

    final public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    final public function dataset(): BelongsTo
    {
        return $this->belongsTo(Dataset::class);
    }

    protected function getChartCountAttribute()
    {
        return count($this->charts);
    }
}
