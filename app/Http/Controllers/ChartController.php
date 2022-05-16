<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Dataset;
use App\Repositories\ChartRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class ChartController extends Controller
{
    private ChartRepository $repository;

    final public function __construct(ChartRepository $repository)
    {
        $this->repository = $repository;
    }

    final public function showForm(Dashboard $dashboard, Request $request): Responsable
    {
        return Inertia::render('Dashboard/CreateChart', [
            'dashboard' => $dashboard,
            'dataset' => $dashboard->dataset
        ]);
    }

    final public function save(Dashboard $dashboard, Dataset $dataset, Request $request)
    {
        $this->repository->save(
            $dashboard,
            $dataset,
            $request->input('type'),
            $request->input('data', [])
        );
    }
}
