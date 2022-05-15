<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Repositories\ChartRepository;
use App\Repositories\DashboardRepository;
use App\Repositories\DatasetRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class DashboardsController extends Controller
{

    private DashboardRepository $dashboardRepository;

    private DatasetRepository $datasetRepository;

    private ChartRepository $chartRepository;

    final public function __construct(
        DashboardRepository $dashboardRepository,
        DatasetRepository $datasetRepository,
        ChartRepository $chartRepository
    ) {
        $this->dashboardRepository = $dashboardRepository;
        $this->datasetRepository = $datasetRepository;
        $this->chartRepository = $chartRepository;
    }

    final public function create(Request $request): Responsable
    {
        return Inertia::render('CreateChart', [
            'dashboards' => $this->dashboardRepository->all($request->user())
        ]);
    }

    final public function store(Request $request)
    {
        $name = $request->input('name', 'Undefined');
        $dashboard = $this->dashboardRepository->create($request->user(), $name);

        return new RedirectResponse(route('dashboard.setup', [
            'dashboard' => $dashboard->id
        ]));
    }

    final public function setup(Dashboard $dashboard, Request $request): Responsable
    {
        return Inertia::render('Dashboard/Setup', [
            'dashboard' => $dashboard,
            'datasets' => $this->datasetRepository->all($request->user())
        ]);
    }

    final public function preview(Dashboard $dashboard, Request $request): Responsable
    {
        return Inertia::render('Dashboard/Preview', [
            'dashboard' => $dashboard,
            'charts' => $this->chartRepository->all($dashboard),
            'datasets' => $this->datasetRepository->all($request->user())
        ]);
    }

    final public function update(Dashboard $dashboard, Request $request)
    {
        $datasetId = $request->input('dataset_id');
        $dashboard->dataset_id = $datasetId;
        $dashboard->save();

        return $dashboard;
    }
}
