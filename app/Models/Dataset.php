<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $table
 * @property array $headlines
 */
final class Dataset extends Model
{
    protected $guarded = [];

    protected $casts = [
        'headlines' => 'array'
    ];

    final public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    final public function rows(): Collection
    {
        $dataset = new DatasetRow();
        $dataset->setTable($this->table);

        return $dataset->newQuery()->get();
    }
}
