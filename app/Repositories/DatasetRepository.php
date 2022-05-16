<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Dataset;
use App\Models\DatasetRow;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class DatasetRepository
{
    final public function all(User $user): Collection
    {
        return $this->newQuery()
            ->where('user_id', '=', $user->id)
            ->get();
    }

    final public function query(Dataset $dataset, string $aggregation, string $aggregationField, string $groupBy): Collection
    {
        $row = new DatasetRow();
        $row->setTable($dataset->table);

        $result = $row->newQuery()->select([
            $groupBy,
            DB::raw($this->buildAggregate($aggregation, $aggregationField))
        ])->groupBy($groupBy)
            ->get();

        return $result;
    }

    private function buildAggregate(string $aggregation, $aggregationField): string
    {
        return $aggregation . '(`' . $aggregationField . '`) as `aggregate`';
    }

    private function newQuery(): Builder
    {
        return (new Dataset())->newQuery();
    }
}
