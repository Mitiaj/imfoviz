<?php
declare(strict_types=1);

namespace App\Models;

final class DatasetRow extends Model
{
    protected $guarded = [];

    public function setTable($table): void
    {
        $this->table = $table;
    }
}
