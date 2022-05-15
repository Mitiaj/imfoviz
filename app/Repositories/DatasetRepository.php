<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Dataset;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class DatasetRepository
{
    final public function all(User $user): Collection
    {
        return $this->newQuery()
            ->where('user_id', '=', $user->id)
            ->get();
    }

    private function newQuery(): Builder
    {
        return (new Dataset())->newQuery();
    }
}
