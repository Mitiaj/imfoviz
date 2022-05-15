<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\DatasetRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class DashboardsController extends Controller
{
    private DatasetRepository $repository;

    final public function __construct(DatasetRepository $repository)
    {
        $this->repository = $repository;
    }

    final public function create(Request $request): Responsable
    {
        return Inertia::render('CreateChart', [
            'datasets' => $this->repository->all($request->user())
        ]);
    }
}
