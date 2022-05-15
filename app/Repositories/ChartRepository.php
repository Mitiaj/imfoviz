<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Chart;
use App\Models\Dashboard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class ChartRepository
{
    final public function all(Dashboard $dashboard): Collection
    {
        return $dashboard->charts()->get();
    }

    private function newQuery(): Builder
    {
        return (new Chart())->newQuery();
    }
}
