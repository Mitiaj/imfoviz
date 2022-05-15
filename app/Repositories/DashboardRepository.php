<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class DashboardRepository
{
    final public function all(User $user): Collection
    {
        return $this->newQuery()->where('user_id', '=', $user->id)->get();
    }

    final public function create(User $user, string $name): Dashboard
    {
        /** @var Dashboard $model */
        $model = $this->newQuery()->create([
            'user_id' => $user->id,
            'name' => $name
        ]);

        return $model;
    }

    private function newQuery(): Builder
    {
        return (new Dashboard())->newQuery();
    }
}
