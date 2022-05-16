<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Chart;
use App\Models\Dashboard;
use App\Models\Dataset;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class ChartRepository
{
    final public function all(Dashboard $dashboard): Collection
    {
        return $dashboard->charts()->get();
    }

    final public function save(Dashboard $dashboard, Dataset $dataset, string $type, array $data): void
    {
        $this->newQuery()->create([
            'dashboard_id' => $dashboard->id,
            'dataset_id' => $dataset->id,
            'chart_type' => $type,
            'data' => $data
        ]);
    }

    private function newQuery(): Builder
    {
        return (new Chart())->newQuery();
    }
}
