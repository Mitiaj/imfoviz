<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class DatasetRow extends Model
{
    protected $guarded = [];

    public function setTable($table): void
    {
        $this->table = $table;
    }
}
