<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Dataset;
use App\Models\DatasetRow;
use App\Models\User;
use App\Services\FieldName;
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

    final public function query(Dataset $dataset, string $aggregation, string $aggregationField, string $groupByField, string $groupByAggregation): Collection
    {
        $row = new DatasetRow();
        $row->setTable($dataset->table);

        $result = $row->newQuery()->select([
            DB::raw($this->buildAggregate($groupByAggregation, $groupByField)),
            DB::raw($this->buildAggregate($aggregation, $aggregationField))
        ])->groupBy(DB::raw($this->buildGroupByAggregate($groupByField, $groupByAggregation)))
            ->get();

        return $result;
    }

    final public function start(Dataset $dataset, string $groupByField, string $groupByAggregation)
    {
        $row = new DatasetRow();
        $row->setTable($dataset->table);

        return $row->newQuery()
            ->select([DB::raw("min({$this->buildGroupByAggregate($groupByField, $groupByAggregation)}) as `min`")])
            ->first()['min'];
    }

    private function buildGroupByAggregate(string $groupBy, string $groupByAggregation = ''): string
    {
        if (empty($groupByAggregation)) {
            return "`$groupBy`";
        }

        return "$groupByAggregation(`$groupBy`)";
    }

    private function buildAggregate(string $aggregation, $aggregationField): string
    {
        $field = (string)new FieldName($aggregation, $aggregationField);

        if (empty($aggregationField)) {
            return "`$aggregation` as `$field`";
        }

        return $aggregation . '(`' . $aggregationField . "`) as `$field`";
    }

    private function newQuery(): Builder
    {
        return (new Dataset())->newQuery();
    }
}
