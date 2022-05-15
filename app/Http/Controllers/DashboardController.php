<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class DashboardController extends Controller
{
    private DashboardRepository $repository;

    final public function __construct(DashboardRepository $repository)
    {
        $this->repository = $repository;
    }

    final public function dashboard(Request $request): Responsable
    {
        return Inertia::render('Dashboard', [
            'dashboards' => $this->repository->all($request->user())
        ]);
    }
}
